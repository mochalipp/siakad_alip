<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Akun tiap level (Part 3) — password semua akun: password123
     * Level: 1 Admin, 2 User, 3 Mahasiswa, 4 Dosen
     * Ganti password ini setelah instalasi pertama!
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Administrator',
                'email' => 'admin@siakad.test',
                'password' => bcrypt('password123'),
                'level' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User Biasa',
                'email' => 'user@siakad.test',
                'password' => bcrypt('password123'),
                'level' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mahasiswa',
                'email' => 'mahasiswa@siakad.test',
                'password' => bcrypt('password123'),
                'level' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dosen',
                'email' => 'dosen@siakad.test',
                'password' => bcrypt('password123'),
                'level' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
