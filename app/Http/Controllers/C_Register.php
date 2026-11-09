<?php

namespace App\Http\Controllers;

use App\Models\M_User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class C_Register extends Controller
{
    public function __construct()
    {
        $this->M_User = new M_User();
    }

    // Tampil halaman register — Part 3
    public function index()
    {
        return view('v_register');
    }

    // Simpan akun baru — Part 3
    public function store()
    {
        Request()->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'level' => 'required|integer|in:1,2,3,4',
        ], [
            'name.required' => 'Nama wajib di isi !',
            'email.required' => 'Email wajib di isi !',
            'email.email' => 'Format email tidak valid !',
            'email.unique' => 'Email ini sudah terdaftar !',
            'password.required' => 'Password wajib di isi !',
            'password.min' => 'Password minimal 6 karakter !',
            'password.confirmed' => 'Konfirmasi password tidak cocok !',
            'level.required' => 'Level wajib di isi !',
            'level.in' => 'Level tidak valid !',
        ]);

        $data = [
            'name' => Request()->name,
            'email' => Request()->email,
            'password' => Hash::make(Request()->password),
            'level' => Request()->level,
        ];
        $this->M_User->addData($data);

        return redirect('/')->with('pesan', 'Akun berhasil dibuat, silahkan login !');
    }
}
