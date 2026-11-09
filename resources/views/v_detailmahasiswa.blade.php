@extends('layout.v_template_tables')
@section('title', 'Detail Mahasiswa')
@section('page', 'Detail Mahasiswa')
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Quick Example</h3>
      </div>
      <form>
        <div class="card-body">
          <div class="form-group">
            <label>NIM</label>
            <p>{{ $mahasiswa->nim }}</p>
          </div>
          <div class="form-group">
            <label>Nama</label>
            <p>{{ $mahasiswa->nama }}</p>
          </div>
          <div class="form-group">
            <label>Jurusan</label>
            <p>{{ $mahasiswa->jurusan }}</p>
          </div>
          <div class="form-group">
            <label>Prodi</label>
            <p>{{ $mahasiswa->prodi }}</p>
          </div>
          <div class="form-group">
            <label>Tempat Tanggal Lahir</label>
            <p>{{ $mahasiswa->ttl }}</p>
          </div>
          <div class="form-group">
            <label>Alamat</label>
            <p>{{ $mahasiswa->alamat }}</p>
          </div>
          <div class="form-group">
            <label>Agama</label>
            <p>{{ $mahasiswa->agama }}</p>
          </div>
          <div class="form-group">
            <label>Tingkat</label>
            <p>{{ $mahasiswa->tingkat }}</p>
          </div>
          <div class="form-group">
            <label>Semester</label>
            <p>{{ $mahasiswa->semester }}</p>
          </div>
          <div class="form-group">
            <label>Nomor Handphone</label>
            <p>{{ $mahasiswa->no_hp }}</p>
          </div>
          <div class="form-group">
            <label>Foto</label>
            <p>
              @if($mahasiswa->foto)
                <img src="{{ url('foto_mahasiswa/'.$mahasiswa->foto) }}" width="200px">
              @else
                -
              @endif
            </p>
          </div>
        </div>
        <div class="card-footer">
          <a href="/mahasiswa" class="btn btn-primary">Kembali</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
