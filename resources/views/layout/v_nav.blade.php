<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="/home" class="brand-link">
    <span class="brand-text font-weight-light">SIAKAD</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="info">
        <a href="#" class="d-block">{{ Auth::user()->name ?? 'Tamu' }}</a>
        @if(Auth::check())
          <span class="badge badge-info">{{ Auth::user()->levelName() }}</span>
        @endif
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="/home" class="nav-link">
            <i class="nav-icon fas fa-home"></i>
            <p>Home</p>
          </a>
        </li>

        {{-- Menu Dosen: hanya untuk Admin (level 1) dan Dosen (level 4) --}}
        @if(Auth::check() && in_array(Auth::user()->level, [1, 4]))
        <li class="nav-item">
          <a href="/dosen" class="nav-link">
            <i class="nav-icon fas fa-chalkboard-teacher"></i>
            <p>Dosen</p>
          </a>
        </li>
        @endif

        {{-- Menu Mahasiswa: hanya untuk Admin (level 1) dan Mahasiswa (level 3) --}}
        @if(Auth::check() && in_array(Auth::user()->level, [1, 3]))
        <li class="nav-item">
          <a href="/mahasiswa" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>Mahasiswa</p>
          </a>
        </li>
        @endif

        {{-- Menu User: hanya untuk Admin (level 1) dan User (level 2) --}}
        @if(Auth::check() && in_array(Auth::user()->level, [1, 2]))
        <li class="nav-item">
          <a href="/user" class="nav-link">
            <i class="nav-icon fas fa-user-cog"></i>
            <p>Data User</p>
          </a>
        </li>
        @endif
        <li class="nav-item">
          <a href="/about" class="nav-link">
            <i class="nav-icon fas fa-info-circle"></i>
            <p>About</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/logout" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>Logout</p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
