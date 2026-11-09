@extends('layout.v_template')
@section('title', 'Tambah Data Dosen')
@section('page', 'Tambah Data Dosen')
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Form Add</h3>
      </div>
      <form action="/dosen/insert" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label>ID Dosen (Otomatis)</label>
            <input type="text" class="form-control" value="{{ $id_otomatis }}" disabled>
            <small class="form-text text-muted">ID digenerate otomatis oleh sistem (Part 3), tidak perlu diinput.</small>
          </div>
          <div class="form-group">
            <label>NIP</label>
            <input type="text" name="nip" class="form-control" placeholder="NIP" value="{{ old('nip') }}">
            <div class="text-danger">
              @error('nip')
                {{ $message }}
              @enderror
            </div>
          </div>
          <div class="form-group">
            <label>Nama Dosen</label>
            <input type="text" name="nama_dosen" class="form-control" placeholder="Nama Dosen" value="{{ old('nama_dosen') }}">
            <div class="text-danger">
              @error('nama_dosen')
                {{ $message }}
              @enderror
            </div>
          </div>
          <div class="form-group">
            <label>Mata Kuliah</label>
            <input type="text" name="mata_kuliah" class="form-control" placeholder="Mata Kuliah" value="{{ old('mata_kuliah') }}">
            <div class="text-danger">
              @error('mata_kuliah')
                {{ $message }}
              @enderror
            </div>
          </div>
          <div class="form-group">
            <label>Foto Dosen</label>
            <div class="input-group">
              <div class="custom-file">
                <input type="file" name="foto_dosen" class="custom-file-input" id="foto_dosen">
                <label class="custom-file-label" for="foto_dosen">Choose file</label>
              </div>
            </div>
            <div class="text-danger">
              @error('foto_dosen')
                {{ $message }}
              @enderror
            </div>
          </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Insert</button>
          <a href="/dosen" class="btn btn-default">Kembali</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
