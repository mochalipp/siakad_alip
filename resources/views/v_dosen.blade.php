@extends('layout.v_template_tables')
@section('title', 'Dosen')
@section('page', 'Halaman Dosen')
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        @if(Auth::check() && Auth::user()->level == 1)
          <a href="/dosen/add" class="btn btn-sm btn-primary">Add Data</a>
        @endif
        <a href="/dosen/print" class="btn btn-sm btn-success" target="_blank"><i class="fas fa-print"></i> Print PDF</a>
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
              <th>NIP</th>
              <th>Nama Dosen</th>
              <th>Mata Kuliah</th>
              <th>Foto Dosen</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; ?>
            @foreach($dosen as $data)
            <tr>
              <td>{{ $no++ }}</td>
              <td>{{ $data->nip }}</td>
              <td>{{ $data->nama_dosen }}</td>
              <td>{{ $data->mata_kuliah }}</td>
              <td>
                @if($data->foto_dosen)
                  <img src="{{ url('foto_dosen/'.$data->foto_dosen) }}" width="100px">
                @else
                  -
                @endif
              </td>
              <td>
                <a href="/dosen/detail/{{ $data->id_dosen }}" class="btn btn-sm btn-success">Detail</a>
                @if(Auth::check() && Auth::user()->level == 1)
                  <a href="/dosen/edit/{{ $data->id_dosen }}" class="btn btn-sm btn-warning">Edit</a>
                  <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete{{ $data->id_dosen }}">
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
              <th>NIP</th>
              <th>Nama Dosen</th>
              <th>Mata Kuliah</th>
              <th>Foto Dosen</th>
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

{{-- Modal konfirmasi hapus per baris (Part 1 & 2) --}}
@foreach($dosen as $data)
<div class="modal fade" id="delete{{ $data->id_dosen }}">
  <div class="modal-dialog">
    <div class="modal-content bg-danger">
      <div class="modal-header">
        <h4 class="modal-title">{{ $data->nama_dosen }}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah anda ingin menghapus data ini ?</p>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-outline-light" data-dismiss="modal">No</button>
        <a href="/dosen/delete/{{ $data->id_dosen }}" class="btn btn-outline-light">Yes</a>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endforeach
@endsection
