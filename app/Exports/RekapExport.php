<?php

namespace App\Exports;

use App\Models\RekapNilai;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class RekapExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $query = RekapNilai::query();

        if ($this->request->kelas_id) {
            $query->where('id_kelas', $this->request->kelas_id);
        }
        if ($this->request->semester_id) {
            $query->where('id_semester', $this->request->semester_id);
        }


        // Load relasi agar nama kelas muncul
        return $query->with(['kelas', 'semester'])->get();
    }

    public function headings(): array
    {
        return ['No', 'Nama', 'NIM', 'Kelas', 'Semester', 'Nilai', 'Huruf', 'IPK', 'Status'];
    }

    public function map($rekap): array
    {
        return [
            $rekap->id,
            $rekap->nama_lengkap,
            $rekap->nim,
            // Mengambil Nama Kelas dari relasi. Jika kosong, tulis strip (-)
            $rekap->kelas->nama_kelas ?? '-',
            $rekap->semester->nama_semester ?? '-',
            number_format($rekap->nilai_angka, 2),
            $rekap->grade->huruf,
            $rekap->grade->bobot,
            $rekap->grade->kategori,
        ];
    }
}
