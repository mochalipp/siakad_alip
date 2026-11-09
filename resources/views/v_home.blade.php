@extends('layout.v_template')
@section('title', 'Home')
@section('page', 'Home')
@section('content')
<div class="row">
  @if(Auth::check() && in_array(Auth::user()->level, [1, 4]))
  <div class="{{ Auth::user()->level == 1 ? 'col-lg-4 col-6' : 'col-lg-6 col-12' }}">
    <div class="small-box bg-info">
      <div class="inner">
        <h3>{{ $jumlah_dosen }}</h3>
        <p>Dosen</p>
      </div>
      <div class="icon">
        <i class="fas fa-chalkboard-teacher"></i>
      </div>
      <a href="/dosen" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  @endif

  @if(Auth::check() && in_array(Auth::user()->level, [1, 3]))
  <div class="{{ Auth::user()->level == 1 ? 'col-lg-4 col-6' : 'col-lg-6 col-12' }}">
    <div class="small-box bg-success">
      <div class="inner">
        <h3>{{ $jumlah_mahasiswa }}</h3>
        <p>Mahasiswa</p>
      </div>
      <div class="icon">
        <i class="fas fa-users"></i>
      </div>
      <a href="/mahasiswa" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  @endif

  @if(Auth::check() && in_array(Auth::user()->level, [1, 2]))
  <div class="{{ Auth::user()->level == 1 ? 'col-lg-4 col-6' : 'col-lg-6 col-12' }}">
    <div class="small-box bg-warning">
      <div class="inner">
        <h3>{{ $jumlah_user }}</h3>
        <p>Data User</p>
      </div>
      <div class="icon">
        <i class="fas fa-user-cog"></i>
      </div>
      <a href="/user" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  @endif
</div>

<div class="row">
  @if(Auth::check() && in_array(Auth::user()->level, [1, 4]))
  <div class="{{ Auth::user()->level == 1 ? 'col-md-6' : 'col-md-12' }}">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Jumlah Dosen per Mata Kuliah</h3>
      </div>
      <div class="card-body">
        <canvas id="chartDosen" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
      </div>
    </div>
  </div>
  @endif

  @if(Auth::check() && in_array(Auth::user()->level, [1, 3]))
  <div class="{{ Auth::user()->level == 1 ? 'col-md-6' : 'col-md-12' }}">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Jumlah Mahasiswa per Prodi</h3>
      </div>
      <div class="card-body">
        <canvas id="chartMahasiswa" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
      </div>
    </div>
  </div>
  @endif
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
  @if(Auth::check() && in_array(Auth::user()->level, [1, 4]))
  // Chart Dosen per Mata Kuliah (Part 3)
  const ctxDosen = document.getElementById('chartDosen');
  if (ctxDosen) {
    new Chart(ctxDosen, {
      type: 'bar',
      data: {
        labels: @json($chart_dosen_label),
        datasets: [{
          label: 'Jumlah Dosen',
          data: @json($chart_dosen_data),
          backgroundColor: 'rgba(60,141,188,0.9)',
          borderColor: 'rgba(60,141,188,0.8)',
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          y: { beginAtZero: true, ticks: { stepSize: 1 } }
        }
      }
    });
  }
  @endif

  @if(Auth::check() && in_array(Auth::user()->level, [1, 3]))
  // Chart Mahasiswa per Prodi (Part 3)
  const ctxMhs = document.getElementById('chartMahasiswa');
  if (ctxMhs) {
    new Chart(ctxMhs, {
      type: 'bar',
      data: {
        labels: @json($chart_mhs_label),
        datasets: [{
          label: 'Jumlah Mahasiswa',
          data: @json($chart_mhs_data),
          backgroundColor: 'rgba(0,166,90,0.9)',
          borderColor: 'rgba(0,166,90,0.8)',
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          y: { beginAtZero: true, ticks: { stepSize: 1 } }
        }
      }
    });
  }
  @endif
</script>
@endpush
