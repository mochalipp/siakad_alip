<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Data contoh dari screenshot materi Part 1 & 2.
     * Foto dikosongkan (null) karena file foto belum ada;
     * foto bisa diupload lewat form tambah/edit dosen.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_dosen')->insert([
            [
                'id_dosen' => 1,
                'nip' => '199001262019031025',
                'nama_dosen' => 'Mohammad Iqbal, S.Kom., M.T.',
                'mata_kuliah' => 'Pemrograman Berorientasi Objek',
                'foto_dosen' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_dosen' => 2,
                'nip' => '198801052019031001',
                'nama_dosen' => 'Tri Herdiawan Apandi, S.ST., M.T.',
                'mata_kuliah' => 'Data Mining',
                'foto_dosen' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
