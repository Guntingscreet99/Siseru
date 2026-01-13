<?php

namespace App\Http\Controllers\Admin\Rekap;

use App\Http\Controllers\Controller;
use App\Models\DataDiri;
use App\Models\DataUjian;
use App\Models\Kelas;
use App\Models\Semester;
use App\Models\Ujian;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;

class RekapUjianController extends Controller
{
    public function index(Request $request)
    {
        $query = DataUjian::query()
            ->leftJoin('kelas', 'data_ujians.kelas_id', '=', 'kelas.id',)
            ->with(['user', 'kelas', 'semester', 'hasilUjian'])
            ->select('data_ujians.*')
            ->orderBy('kelas.nama_kelas', 'asc')   // ⬅️ URUT KELAS A–Z
            ->orderBy('data_ujians.created_at', 'desc');

        if ($request->kelas) {
            $query->where('kelas_id', $request->kelas);
        }

        if ($request->search) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                    ->orWhere('nim', 'like', "%{$request->search}%");
            });
        }

        $rekap = $query->paginate($request->entries ?? 10);

        // dd($rekap);

        // Kelas dropdown juga diurutkan
        $kelas = Kelas::orderBy('nama_kelas', 'asc')->get();
        $semester = Semester::orderBy('nama_semester', 'asc')->get();

        $lastUpload = DataUjian::orderBy('created_at', 'desc')->first();
        $lastUpdate = DataUjian::orderBy('updated_at', 'desc')->first();

        return view('admin.rekap.ujian.index', compact('rekap', 'kelas', 'semester', 'lastUpload', 'lastUpdate'));
    }


    // Fungsi format excel
    public function format(Request $request)
    {
        $filePath = public_path('formats/format_import_ujian.xlsx');

        return response()->download($filePath, 'format_import_ujian.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        DB::beginTransaction();

        try {
            $spreadsheet = IOFactory::load($request->file('file')->getPathname());
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray(null, true, true, true);

            // Header
            $headerRow = array_map('trim', array_values($rows[1]));
            $headerMap = array_flip($headerRow);

            $requiredHeaders = ['Timestamp', 'Score', 'NIM'];
            foreach ($requiredHeaders as $h) {
                if (!isset($headerMap[$h])) {
                    throw new \Exception("Header '$h' tidak ditemukan di Excel");
                }
            }

            foreach (array_slice($rows, 1) as $index => $row) {
                $row = array_values($row);

                $nim = trim($row[$headerMap['NIM']] ?? '');
                if (!$nim) {
                    continue;
                }

                // === USER (boleh null) ===
                $user = User::where('nim', $nim)->first();
                $userId = $user?->id;

                // === KELAS ===
                $kelasId = null;
                if (isset($headerMap['Kelas'])) {
                    $kelasText = trim($row[$headerMap['Kelas']] ?? '');
                    if ($kelasText !== '') {
                        $kelas = Kelas::where('nama_kelas', $kelasText)->first();
                        $kelasId = $kelas?->id;
                    }
                }

                // === SEMESTER ===
                $semesterId = null;
                if (isset($headerMap['Semester'])) {
                    $semesterText = trim($row[$headerMap['Semester']] ?? '');
                    if ($semesterText !== '') {
                        $semester = Semester::where('nama_semester', $semesterText)->first();
                        $semesterId = $semester?->id;
                    }
                }

                // === SCORE ===
                $scoreString = $row[$headerMap['Score']] ?? '0';
                preg_match('/(\d+)/', $scoreString, $matches);
                $score = (int) ($matches[1] ?? 0);

                // === WAKTU ===
                $waktu = null;
                $timestampExcel = $row[$headerMap['Timestamp']] ?? null;

                if ($timestampExcel !== null && $timestampExcel !== '') {
                    if (is_numeric($timestampExcel)) {
                        $waktu = ExcelDate::excelToDateTimeObject($timestampExcel);
                    } else {
                        try {
                            $waktu = Carbon::parse($timestampExcel);
                        } catch (\Exception $e) {
                            Log::warning("Timestamp tidak valid: $timestampExcel (NIM $nim)");
                        }
                    }
                }

                // === CEK DATA UJIAN BERDASARKAN USER + KELAS + SEMESTER ===
                $existingUjian = DataUjian::where('user_id', $userId)
                    ->where('kelas_id', $kelasId)
                    ->where('semester_id', $semesterId)
                    ->first();

                if ($existingUjian) {
                    // UPDATE JIKA SUDAH ADA
                    $existingUjian->update([
                        'score'            => $score,
                        'waktu_pengerjaan' => $waktu?->format('Y-m-d'),
                        'status'           => 'import',
                    ]);
                } else {
                    // INSERT JIKA BELUM ADA
                    DataUjian::create([
                        'user_id'          => $userId,
                        'kelas_id'         => $kelasId,
                        'semester_id'      => $semesterId,
                        'score'            => $score,
                        'waktu_pengerjaan' => $waktu?->format('Y-m-d'),
                        'status'           => 'import',
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => 'Import berhasil'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Import ujian gagal: ' . $e->getMessage());

            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        $rekap = DataUjian::findOrFail($id);
        $rekap->delete();

        return redirect()->route('admin.rekap.ujian')
            ->with('success', 'Data ujian berhasil dihapus!');
    }
}
