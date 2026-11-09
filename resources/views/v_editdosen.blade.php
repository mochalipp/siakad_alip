@extends('layout.v_template')
@section('title', 'Edit Data Dosen')
@section('page', 'Edit Data Dosen')
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Form Edit</h3>
      </div>
      <form action="/dosen/update/{{ $dosen->id_dosen }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label>NIP</label>
            <input type="text" name="nip" class="form-control" placeholder="NIP" value="{{ $dosen->nip }}" readonly>
            <div class="text-danger">
              @error('nip')
                {{ $message }}
              @enderror
            </div>
          </div>
          <div class="form-group">
            <label>Nama Dosen</label>
            <input type="text" name="nama_dosen" class="form-control" placeholder="Nama Dosen" value="{{ $dosen->nama_dosen }}">
            <div class="text-danger">
              @error('nama_dosen')
                {{ $message }}
              @enderror
            </div>
          </div>
          <div class="form-group">
            <label>Mata Kuliah</label>
            <input type="text" name="mata_kuliah" class="form-control" placeholder="Mata Kuliah" value="{{ $dosen->mata_kuliah }}">
            <div class="text-danger">
              @error('mata_kuliah')
                {{ $message }}
              @enderror
            </div>
          </div>
          <div class="form-group">
            <label>Foto Dosen</label>
            <p>
              @if($dosen->foto_dosen)
                <img src="{{ url('foto_dosen/'.$dosen->foto_dosen) }}" width="100px">
              @else
                <span class="text-muted">Belum ada foto</span>
              @endif
            </p>
            <div class="input-group">
              <div class="custom-file">
                <input type="file" name="foto_dosen" class="custom-file-input" id="foto_dosen">
                <label class="custom-file-label" for="foto_dosen">Choose file</label>
              </div>
            </div>
            <small class="form-text text-muted">Kosongkan jika tidak ingin mengganti foto.</small>
            <div class="text-danger">
              @error('foto_dosen')
                {{ $message }}
              @enderror
            </div>
          </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Update</button>
          <a href="/dosen" class="btn btn-default">Kembali</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
