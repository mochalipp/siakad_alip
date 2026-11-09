@extends('layout.v_template_tables')
@section('title', 'Detail Dosen')
@section('page', 'Detail Dosen')
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
            <label>NIP</label>
            <p>{{ $dosen->nip }}</p>
          </div>
          <div class="form-group">
            <label>Nama Dosen</label>
            <p>{{ $dosen->nama_dosen }}</p>
          </div>
          <div class="form-group">
            <label>Mata Kuliah</label>
            <p>{{ $dosen->mata_kuliah }}</p>
          </div>
          <div class="form-group">
            <label>Foto Dosen</label>
            <p>
              @if($dosen->foto_dosen)
                <img src="{{ url('foto_dosen/'.$dosen->foto_dosen) }}" width="200px">
              @else
                -
              @endif
            </p>
          </div>
        </div>
        <div class="card-footer">
          <a href="/dosen" class="btn btn-primary">Kembali</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
