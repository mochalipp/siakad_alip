<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Data Dosen — SIAKAD</title>
  <style>
    body { font-family: sans-serif; font-size: 12px; }
    h2, p { text-align: center; margin: 4px 0; }
    table { width: 100%; border-collapse: collapse; margin-top: 16px; }
    th, td { border: 1px solid #000; padding: 6px; text-align: left; }
    th { background-color: #eee; }
  </style>
</head>
<body>
  <h2>Data Dosen</h2>
  <p>Sistem Informasi Akademik — Politeknik Negeri Subang</p>
  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>NIP</th>
        <th>Nama Dosen</th>
        <th>Mata Kuliah</th>
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
      </tr>
      @endforeach
    </tbody>
  </table>
</body>
</html>
