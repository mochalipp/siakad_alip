<?php

namespace App\Http\Controllers;

use App\Models\M_User;

class C_User extends Controller
{
    public function __construct()
    {
        $this->M_User = new M_User();
    }

    // Halaman User — daftar semua akun (khusus Admin, Part 3)
    public function index()
    {
        $data = [
            'user' => $this->M_User->allData(),
        ];
        return view('v_user', $data);
    }
}
