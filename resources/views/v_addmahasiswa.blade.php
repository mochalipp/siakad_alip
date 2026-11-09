@extends('layout.v_template')
@section('title', 'Tambah Data Mahasiswa')
@section('page', 'Tambah Data Mahasiswa')
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Form Add</h3>
      </div>
      <form action="/mahasiswa/insert" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label>NIM</label>
            <input type="text" name="nim" class="form-control" placeholder="NIM" value="{{ old('nim') }}">
            <div class="text-danger">
              @error('nim')
                {{ $message }}
              @enderror
            </div>
          </div>
          <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" placeholder="Nama" value="{{ old('nama') }}">
            <div class="text-danger">
              @error('nama')
                {{ $message }}
              @enderror
            </div>
          </div>
          <div class="form-group">
            <label>Jurusan</label>
            <input type="text" name="jurusan" class="form-control" placeholder="Jurusan" value="{{ old('jurusan') }}">
            <div class="text-danger">
              @error('jurusan')
                {{ $message }}
              @enderror
            </div>
          </div>
          <div class="form-group">
            <label>Prodi</label>
            <input type="text" name="prodi" class="form-control" placeholder="Prodi" value="{{ old('prodi') }}">
            <div class="text-danger">
              @error('prodi')
                {{ $message }}
              @enderror
            </div>
          </div>
          <div class="form-group">
            <label>Tempat Tanggal Lahir</label>
            <input type="text" name="ttl" class="form-control" placeholder="Contoh: Subang, 1 Januari 2006" value="{{ old('ttl') }}">
            <div class="text-danger">
              @error('ttl')
                {{ $message }}
              @enderror
            </div>
          </div>
          <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" placeholder="Alamat">{{ old('alamat') }}</textarea>
            <div class="text-danger">
              @error('alamat')
                {{ $message }}
              @enderror
            </div>
          </div>
          <div class="form-group">
            <label>Agama</label>
            <select name="agama" class="form-control">
              <option value="">-- Pilih Agama --</option>
              <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
              <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
              <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
              <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
              <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
              <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
            </select>
            <div class="text-danger">
              @error('agama')
                {{ $message }}
              @enderror
            </div>
          </div>
          <div class="form-group">
            <label>Tingkat</label>
            <input type="number" name="tingkat" class="form-control" placeholder="Tingkat" value="{{ old('tingkat') }}">
            <div class="text-danger">
              @error('tingkat')
                {{ $message }}
              @enderror
            </div>
          </div>
          <div class="form-group">
            <label>Semester</label>
            <input type="number" name="semester" class="form-control" placeholder="Semester" value="{{ old('semester') }}">
            <div class="text-danger">
              @error('semester')
                {{ $message }}
              @enderror
            </div>
          </div>
          <div class="form-group">
            <label>Nomor Handphone</label>
            <input type="text" name="no_hp" class="form-control" placeholder="Nomor Handphone" value="{{ old('no_hp') }}">
            <div class="text-danger">
              @error('no_hp')
                {{ $message }}
              @enderror
            </div>
          </div>
          <div class="form-group">
            <label>Foto</label>
            <div class="input-group">
              <div class="custom-file">
                <input type="file" name="foto" class="custom-file-input" id="foto">
                <label class="custom-file-label" for="foto">Choose file</label>
              </div>
            </div>
            <div class="text-danger">
              @error('foto')
                {{ $message }}
              @enderror
            </div>
          </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Insert</button>
          <a href="/mahasiswa" class="btn btn-default">Kembali</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
