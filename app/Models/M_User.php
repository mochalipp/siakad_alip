<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class M_User extends Model
{
    // Model user memakai Query Builder (DB facade), konsisten dengan
    // M_Dosen dan M_Mahasiswa, sesuai pola materi PBO Pertemuan 12 Part 3.

    public function allData()
    {
        return DB::table('users')->get();
    }

    public function detailData($id)
    {
        return DB::table('users')->where('id', $id)->first();
    }

    public function addData($data)
    {
        return DB::table('users')->insert($data);
    }

    public function editData($id, $data)
    {
        return DB::table('users')->where('id', $id)->update($data);
    }

    public function deleteData($id)
    {
        return DB::table('users')->where('id', $id)->delete();
    }
}
