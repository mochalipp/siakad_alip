<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Tabel tb_dosen — Part 1.
     * Catatan: foto_dosen dibuat nullable supaya data seeder / data awal
     * tetap bisa dibuat tanpa file foto (di form tambah, foto tetap wajib
     * sesuai validasi materi Part 2).
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_dosen', function (Blueprint $table) {
            $table->integer('id_dosen')->primary();
            $table->string('nip', 200)->unique();
            $table->string('nama_dosen', 200);
            $table->string('mata_kuliah', 200);
            $table->string('foto_dosen', 200)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_dosen');
    }
};
