@extends('layout.v_template_tables')
@section('title', 'User')
@section('page', 'Halaman User')
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Data User</h3>
      </div>
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
              <th>Nama</th>
              <th>Email</th>
              <th>Level</th>
              <th>Dibuat</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; ?>
            @foreach($user as $data)
            <tr>
              <td>{{ $no++ }}</td>
              <td>{{ $data->name }}</td>
              <td>{{ $data->email }}</td>
              <td>
                @if($data->level == 1)
                  <span class="badge badge-danger">Admin</span>
                @elseif($data->level == 2)
                  <span class="badge badge-primary">User</span>
                @elseif($data->level == 3)
                  <span class="badge badge-success">Mahasiswa</span>
                @elseif($data->level == 4)
                  <span class="badge badge-warning">Dosen</span>
                @endif
              </td>
              <td>{{ $data->created_at }}</td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Email</th>
              <th>Level</th>
              <th>Dibuat</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
