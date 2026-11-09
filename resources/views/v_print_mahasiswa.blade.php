<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Data Mahasiswa — SIAKAD</title>
  <style>
    body { font-family: sans-serif; font-size: 12px; }
    h2, p { text-align: center; margin: 4px 0; }
    table { width: 100%; border-collapse: collapse; margin-top: 16px; }
    th, td { border: 1px solid #000; padding: 6px; text-align: left; }
    th { background-color: #eee; }
  </style>
</head>
<body>
  <h2>Data Mahasiswa</h2>
  <p>Sistem Informasi Akademik — Politeknik Negeri Subang</p>
  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>NIM</th>
        <th>Nama</th>
        <th>Jurusan</th>
        <th>Prodi</th>
        <th>Semester</th>
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
        <td>{{ $data->semester }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</body>
</html>
