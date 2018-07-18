<div class="sidebar">
    <nav class="sidebar-nav">
      <ul class="nav">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('simrs.index') }}">
            <i class="nav-icon icon-speedometer"></i> Dashboard
          </a>
        </li>
        <li class="nav-item nav-dropdown">
          <a class="nav-link nav-dropdown-toggle" href="#">
            <i class="nav-icon icon-pencil"></i> Master</a>
          <ul class="nav-dropdown-items">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('simrs.tarifkarcis') }}">
                <i class="nav-icon icon-puzzle"></i> Tarif Klinik</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('simrs.jadwaldokter') }}">
                <i class="nav-icon icon-puzzle"></i> Jadwal Dokter</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('simrs.jadwaldokterpengganti') }}">
                <i class="nav-icon icon-puzzle"></i> Dokter Pengganti</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('simrs.pegawai') }}">
                <i class="nav-icon icon-people"></i> Pegawai</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('simrs.pasien') }}">
                <i class="nav-icon icon-people"></i> Pasien</a>
            </li>
          </ul>
        </li>
        <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle" href="#">
              <i class="nav-icon icon-note"></i> Register</a>
            <ul class="nav-dropdown-items">
              <li class="nav-item">
                <a class="nav-link" href="{{ route('simrs.rawatjalan') }}">
                  <i class="nav-icon icon-puzzle"></i> Rawat Jalan</a>
              </li>
              {{-- <li class="nav-item">
                <a class="nav-link" href="#">
                  <i class="nav-icon icon-puzzle"></i> Rawat Inap</a>
              </li> --}}
            </ul>
          </li>
      </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
  </div>