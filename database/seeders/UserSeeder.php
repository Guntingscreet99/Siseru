<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'username' => 'Admin',
                'password' => bcrypt('1'),
                'email' => 'admin12@gmail.com',
                'role' => 'admin',
                'status' => 'A',
                'no_hp' => '085866090206',
            ],
            [
                'id' => 2,
                'username' => 'Nur Fajrie',
                'password' => bcrypt('1'),
                'email' => 'nurfajrie@gmail.com',
                'role' => 'dosen',
                'status' => 'A',
                'no_hp' => '088866090207',
            ]
        ];

        foreach ($data as $key => $user) {
            User::create($user);
        }
    }
}
