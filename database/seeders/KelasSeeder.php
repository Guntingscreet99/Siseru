<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kelas = [
            [
                'id' => 1,
                'nama_kelas' => 'A',
            ],
            [
                'id' => 2,
                'nama_kelas' => 'B',
            ],
            [
                'id' => 3,
                'nama_kelas' => 'C',
            ],
            [
                'id' => 4,
                'nama_kelas' => 'D',
            ],
            [
                'id' => 5,
                'nama_kelas' => 'E',
            ],
            [
                'id' => 6,
                'nama_kelas' => 'F'
            ],
            [
                'id' => 7,
                'nama_kelas' => 'G'
            ],
            [
                'id' => 8,
                'nama_kelas' => 'H'
            ],
            [
                'id' => 9,
                'nama_kelas' => 'I'
            ],
            [
                'id' => 10,
                'nama_kelas' => 'J'
            ]
        ];

        foreach ($kelas as $key => $kel) {
            Kelas::create($kel);
        }
    }
}
