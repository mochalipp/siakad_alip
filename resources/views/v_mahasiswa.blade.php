@extends('layout.v_template_tables')
@section('title', 'Mahasiswa')
@section('page', 'Halaman Mahasiswa')
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        @if(Auth::check() && Auth::user()->level == 1)
          <a href="/mahasiswa/add" class="btn btn-sm btn-primary">Add Data</a>
        @endif
        <a href="/mahasiswa/print" class="btn btn-sm btn-success" target="_blank"><i class="fas fa-print"></i> Print PDF</a>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        @if(session('pesan'))
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i> Success!</h5>
            {{ session('pesan') }}
          </div>
        @endif
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>NIM</th>
              <th>Nama</th>
              <th>Jurusan</th>
              <th>Prodi</th>
              <th>Foto</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; ?>
            @foreach($mahasiswa as $data)
            <tr>
              <td>{{ $no++ }}</td>
              <td>{{ $data->nim }}</td>
              <td>{{ $data->nama }}</td>
              <td>{{ $data->jurusan }}</td>
              <td>{{ $data->prodi }}</td>
              <td>
                @if($data->foto)
                  <img src="{{ url('foto_mahasiswa/'.$data->foto) }}" width="100px">
                @else
                  -
                @endif
              </td>
              <td>
                <a href="/mahasiswa/detail/{{ $data->nim }}" class="btn btn-sm btn-success">Detail</a>
                @if(Auth::check() && Auth::user()->level == 1)
                  <a href="/mahasiswa/edit/{{ $data->nim }}" class="btn btn-sm btn-warning">Edit</a>
                  <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete{{ $data->nim }}">
                    Delete
                  </button>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th>No</th>
              <th>NIM</th>
              <th>Nama</th>
              <th>Jurusan</th>
              <th>Prodi</th>
              <th>Foto</th>
              <th>Action</th>
            </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->

{{-- Modal konfirmasi hapus per baris --}}
@foreach($mahasiswa as $data)
<div class="modal fade" id="delete{{ $data->nim }}">
  <div class="modal-dialog">
    <div class="modal-content bg-danger">
      <div class="modal-header">
        <h4 class="modal-title">{{ $data->nama }}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah anda ingin menghapus data ini ?</p>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-outline-light" data-dismiss="modal">No</button>
        <a href="/mahasiswa/delete/{{ $data->nim }}" class="btn btn-outline-light">Yes</a>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endforeach
@endsection
