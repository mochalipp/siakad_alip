<?php

use App\Http\Controllers\C_Dosen;
use App\Http\Controllers\C_Home;
use App\Http\Controllers\C_Login;
use App\Http\Controllers\C_Mahasiswa;
use App\Http\Controllers\C_Register;
use App\Http\Controllers\C_User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes — SIAKAD (PBO Pertemuan 12)
|--------------------------------------------------------------------------
| Pola route mengikuti materi: login di '/', home, about, CRUD Dosen,
| CRUD Mahasiswa (latihan soal), user, register, dan print PDF.
| Middleware level (Part 3): admin, user, mahasiswa, dosen.
| Perhatian: delete memakai GET sesuai pola materi (bukan DELETE/POST).
|
*/

// Login / Register / Logout (Part 3)
Route::get('/', [C_Login::class, 'index']);
Route::post('/login', [C_Login::class, 'login']);
Route::get('/logout', [C_Login::class, 'logout']);
Route::get('/register', [C_Register::class, 'index']);
Route::post('/register', [C_Register::class, 'store']);

// Home & About (harus login)
Route::get('/home', [C_Home::class, 'index'])->middleware('auth');
Route::get('/about', [C_Home::class, 'about'])->middleware('auth');
Route::get('/about2/{id}', [C_Home::class, 'about2'])->middleware('auth');

// User (Admin & User)
Route::get('/user', [C_User::class, 'index'])->middleware(['auth', 'user'])->name('user');

// Dosen (Admin & Dosen)
Route::get('/dosen', [C_Dosen::class, 'index'])->name('dosen')->middleware(['auth', 'dosen']);
Route::get('/dosen/print', [C_Dosen::class, 'print'])->middleware(['auth', 'dosen']);
Route::get('/dosen/detail/{id_dosen}', [C_Dosen::class, 'detail'])->middleware(['auth', 'dosen']);
Route::get('/dosen/add', [C_Dosen::class, 'add'])->middleware(['auth', 'admin']);
Route::post('/dosen/insert', [C_Dosen::class, 'insert'])->middleware(['auth', 'admin']);
Route::get('/dosen/edit/{id_dosen}', [C_Dosen::class, 'edit'])->middleware(['auth', 'admin']);
Route::post('/dosen/update/{id_dosen}', [C_Dosen::class, 'update'])->middleware(['auth', 'admin']);
Route::get('/dosen/delete/{id_dosen}', [C_Dosen::class, 'delete'])->middleware(['auth', 'admin']);

// Mahasiswa (Admin & Mahasiswa)
Route::get('/mahasiswa', [C_Mahasiswa::class, 'index'])->name('mahasiswa')->middleware(['auth', 'mahasiswa']);
Route::get('/mahasiswa/print', [C_Mahasiswa::class, 'print'])->middleware(['auth', 'mahasiswa']);
Route::get('/mahasiswa/detail/{nim}', [C_Mahasiswa::class, 'detail'])->middleware(['auth', 'mahasiswa']);
Route::get('/mahasiswa/add', [C_Mahasiswa::class, 'add'])->middleware(['auth', 'admin']);
Route::post('/mahasiswa/insert', [C_Mahasiswa::class, 'insert'])->middleware(['auth', 'admin']);
Route::get('/mahasiswa/edit/{nim}', [C_Mahasiswa::class, 'edit'])->middleware(['auth', 'admin']);
Route::post('/mahasiswa/update/{nim}', [C_Mahasiswa::class, 'update'])->middleware(['auth', 'admin']);
Route::get('/mahasiswa/delete/{nim}', [C_Mahasiswa::class, 'delete'])->middleware(['auth', 'admin']);
