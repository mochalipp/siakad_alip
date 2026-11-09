@extends('layout.v_template')
@section('title', 'About')
@section('page', 'About')
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Tentang SIAKAD</h3>
      </div>
      <div class="card-body">
        <p>
          <strong>SIAKAD</strong> (Sistem Informasi Akademik) adalah aplikasi berbasis
          <strong>Laravel 13</strong> yang dibangun pada mata kuliah Pemrograman
          Berorientasi Objek 1 (Pertemuan 12), Politeknik Negeri Subang.
        </p>
        <p>
          Aplikasi ini mengelola data Dosen dan Mahasiswa (tampil, detail, tambah,
          edit, hapus), login multiuser 4 level (Admin, User, Mahasiswa, Dosen),
          print data ke PDF, serta grafik data.
        </p>
        @if(isset($id))
          <p>ID yang dibuka: <strong>{{ $id }}</strong></p>
        @endif
        <p>
          Dosen pengampu: Erick Febriyanto, S.Kom., M.TI.
        </p>
      </div>
      <div class="card-footer">
        <a href="/home" class="btn btn-primary">Kembali</a>
      </div>
    </div>
  </div>
</div>
@endsection
