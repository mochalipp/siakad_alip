<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Tabel tb_mahasiswa — latihan soal Part 1 & 2.
     * Primary key NIM (varchar 20). Field mengikuti latihan soal materi:
     * nim, nama, jurusan, prodi, ttl, alamat, agama, tingkat, semester,
     * nomor handphone, foto.
     * Catatan: kolom foto dibuat nullable (lihat catatan di migrasi tb_dosen).
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_mahasiswa', function (Blueprint $table) {
            $table->string('nim', 20)->primary();
            $table->string('nama', 100);
            $table->string('jurusan', 100);
            $table->string('prodi', 100);
            $table->string('ttl', 100);
            $table->text('alamat');
            $table->string('agama', 100);
            $table->integer('tingkat');
            $table->integer('semester');
            $table->string('no_hp', 20);
            $table->string('foto', 200)->nullable();
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
        Schema::dropIfExists('tb_mahasiswa');
    }
};
