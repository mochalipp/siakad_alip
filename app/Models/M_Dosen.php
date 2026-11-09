<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class M_Dosen extends Model
{
    // Model ini memakai Query Builder (DB facade), BUKAN Eloquent.
    // Sesuai materi PBO Pertemuan 12 Part 1 & 2.

    public function allData()
    {
        return DB::table('tb_dosen')->get();
    }

    public function detailData($id_dosen)
    {
        return DB::table('tb_dosen')->where('id_dosen', $id_dosen)->first();
    }

    public function addData($data)
    {
        return DB::table('tb_dosen')->insert($data);
    }

    public function editData($id_dosen, $data)
    {
        return DB::table('tb_dosen')->where('id_dosen', $id_dosen)->update($data);
    }

    public function deleteData($id_dosen)
    {
        return DB::table('tb_dosen')->where('id_dosen', $id_dosen)->delete();
    }

    // ID Otomatis (Part 3): id_dosen = nilai maksimum yang ada + 1.
    // Dipakai saat tambah data supaya id tidak diinput manual.
    public function getNextId()
    {
        $max = DB::table('tb_dosen')->max('id_dosen');
        return $max ? $max + 1 : 1;
    }

    // Data untuk Chart (Part 3): jumlah dosen per mata kuliah.
    public function countPerMataKuliah()
    {
        return DB::table('tb_dosen')
            ->select('mata_kuliah', DB::raw('COUNT(*) as jumlah'))
            ->groupBy('mata_kuliah')
            ->get();
    }
}
