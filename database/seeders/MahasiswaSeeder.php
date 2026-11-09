<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Data contoh mahasiswa (2 baris) supaya halaman Mahasiswa
     * tidak kosong saat pertama kali dibuka.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_mahasiswa')->insert([
            [
                'nim' => '2026001',
                'nama' => 'Mochammad Alif Hafitturrohman',
                'jurusan' => 'Teknologi Informasi dan Komputer',
                'prodi' => 'Teknologi Rekayasa Perangkat Lunak',
                'ttl' => 'Subang, 1 Januari 2006',
                'alamat' => 'Cibogo, Kabupaten Subang, Jawa Barat',
                'agama' => 'Islam',
                'tingkat' => 2,
                'semester' => 3,
                'no_hp' => '081234567890',
                'foto' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nim' => '2026002',
                'nama' => 'Budi Santoso',
                'jurusan' => 'Teknologi Informasi dan Komputer',
                'prodi' => 'Teknologi Rekayasa Perangkat Lunak',
                'ttl' => 'Subang, 2 Februari 2006',
                'alamat' => 'Subang, Jawa Barat',
                'agama' => 'Islam',
                'tingkat' => 2,
                'semester' => 3,
                'no_hp' => '081234567891',
                'foto' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
