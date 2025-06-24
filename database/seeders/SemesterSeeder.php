<?php

namespace Database\Seeders;

use App\Models\Semester;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $semester = [
            [
                'id' => 1,
                'nama_semester' => '1',
                'periode' => '-',
            ],
            [
                'id' => 2,
                'nama_semester' => '2',
                'periode' => '-',
            ],
            [
                'id' => 3,
                'nama_semester' => '3',
                'periode' => '-',
            ],
            [
                'id' => 4,
                'nama_semester' => '4',
                'periode' => '-',
            ],
            [
                'id' => 5,
                'nama_semester' => '5',
                'periode' => '-',
            ],
            [
                'id' => 6,
                'nama_semester' => '6',
                'periode' => '-',
            ],
            [
                'id' => 7,
                'nama_semester' => '7',
                'periode' => '-',
            ],
            [
                'id' => 8,
                'nama_semester' => '8',
                'periode' => '-',
            ]
        ];

        foreach ($semester as $key => $sem) {
            Semester::create($sem);
        }
    }
}
