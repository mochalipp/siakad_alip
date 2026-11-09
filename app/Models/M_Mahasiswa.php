<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class M_Mahasiswa extends Model
{
    // Model ini memakai Query Builder (DB facade), BUKAN Eloquent.
    // Pola sama dengan M_Dosen, tapi primary key-nya NIM (varchar),
    // sesuai latihan soal materi PBO Pertemuan 12 Part 1 & 2.

    public function allData()
    {
        return DB::table('tb_mahasiswa')->get();
    }

    public function detailData($nim)
    {
        return DB::table('tb_mahasiswa')->where('nim', $nim)->first();
    }

    public function addData($data)
    {
        return DB::table('tb_mahasiswa')->insert($data);
    }

    public function editData($nim, $data)
    {
        return DB::table('tb_mahasiswa')->where('nim', $nim)->update($data);
    }

    public function deleteData($nim)
    {
        return DB::table('tb_mahasiswa')->where('nim', $nim)->delete();
    }

    // NIM Otomatis (Part 3): NIM adalah identitas mahasiswa, jadi secara
    // default tetap diinput manual. Method ini memberi SARAN NIM otomatis
    // (tahun berjalan + nomor urut 3 digit) yang ditampilkan di form tambah
    // dan masih bisa diubah manual sebelum disimpan.
    // Contoh: 2026001, 2026002, ...
    public function generateNim()
    {
        $tahun = date('Y');
        $jumlah = DB::table('tb_mahasiswa')
            ->where('nim', 'like', $tahun . '%')
            ->count();
        return $tahun . str_pad($jumlah + 1, 3, '0', STR_PAD_LEFT);
    }

    // Data untuk Chart (Part 3): jumlah mahasiswa per prodi.
    public function countPerProdi()
    {
        return DB::table('tb_mahasiswa')
            ->select('prodi', DB::raw('COUNT(*) as jumlah'))
            ->groupBy('prodi')
            ->get();
    }
}
