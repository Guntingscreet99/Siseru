<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ===============================
        // USER TETAP (ID 1 & 2)
        // ===============================
        $fixedUsers = [
            [
                'id'            => 1,
                'username'      => 'Admin',
                'nama_lengkap'  => 'Administrator Sistem',
                'nim'           => null,
                'email'         => 'admin12@gmail.com',
                'password'      => Hash::make('1'),
                'role'          => 'admin',
                'status'        => 'A',
                'no_hp'         => '085866090206',
            ],
            [
                'id'            => 2,
                'username'      => 'NurFajrie',
                'nama_lengkap'  => 'Nur Fajrie',
                'nim'           => null,
                'email'         => 'nurfajrie@gmail.com',
                'password'      => Hash::make('1'),
                'role'          => 'dosen',
                'status'        => 'A',
                'no_hp'         => '088866090207',
            ],
        ];

        foreach ($fixedUsers as $user) {
            User::updateOrCreate(['id' => $user['id']], $user);
        }

        // ===============================
        // DATA NAMA INDONESIA
        // ===============================
        $namaIndonesia = [
            'LD',
            'MNI',
            'FR',
            'APR',
            'LKS',
            'MAS',
            'AF',
            'AY',
            'AAH',
            'AT',
            'AFM',
            'MDA',
            'OKK',
            'MZA',
            'MAK',
            'VRR',
            'ACF',
            'NS',
            'HI',
            'AAR',
            'UK',
            'CFR',
            'IM',
            'HN',
            'MF',
            'RFJP',
            'NSJ',
            'AFA',
            'SM',
            'VI',

        ];

        // ===============================
        // BUAT 50 USER MAHASISWA
        // ===============================
        $nimAwal = 00;

        foreach ($namaIndonesia as $index => $nama) {

            $nim = $nimAwal + $index + 1;

            // email dari nama lengkap
            $email = Str::of($nama)
                ->lower()
                ->replace(' ', '.')
                ->append('@gmail.com');

            User::create([
                'username'      => Str::slug($nama, '_'),
                'nama_lengkap'  => $nama,
                'nim'           => $nim,
                'email'         => $email,
                'password'      => Hash::make($password = 'mahasiswa' . ($index + 1)),
                'password_plain'  => $password,
                'role'          => 'mahasiswa',
                'status'        => 'A',
                'no_hp'         => '08' . rand(1000000000, 9999999999),
            ]);
        }
    }
}
