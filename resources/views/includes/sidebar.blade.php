<aside id="sidebar-wrapper">
    <div class="sidebar-brand px-2 pt-3 mb-5">
        {{-- <a href="">{{ env('APP_NAME') }}</a> --}}
        <a href="/dashboard">
            <img class="img-fluid" src="{{ url('/assets/img/logo.png') }}" alt="LOGO">
        </a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="">SPU</a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Main Menu</li>


        @can('admin')
        <li class="{{ Route::is('dashboard*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="fas fa-fire"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item dropdown {{ Route::is('auditor*') || Route::is('admin*') || Route::is('prodi*') || Route::is('fakultas*') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown">
                <i class="fas fa-user"></i>
                <span>User</span>
            </a>
            <ul class="dropdown-menu">
                <li class="{{ Route::is('admin*') ? 'active' : '' }}">
                    <a href="{{ route('admin.index') }}">Admin</a>
                </li>
                <li class="{{ Route::is('auditor*') ? 'active' : '' }}">
                    <a href="{{ route('auditor.index') }}">Auditor</a>
                </li>
                <li class="{{ Route::is('prodi*') ? 'active' : '' }}">
                    <a href="{{ route('prodi.index') }}">Prodi</a>
                </li>
                <li class="{{ Route::is('fakultas*') ? 'active' : '' }}">
                    <a href="{{ route('fakultas.index') }}">Fakultas</a>
                </li>
            </ul>
        </li>
        <li class="nav-item dropdown {{ Route::is('nilai*') || Route::is('ami*') || Route::is('tahun*') || Route::is('standar*') || Route::is('pertanyaan*') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown">
                <i class="fas fa-table"></i>
                <span>AMI</span>
            </a>
            <ul class="dropdown-menu">
                <li class="{{ Route::is('ami*') ? 'active' : '' }}">
                    <a href="{{ route('ami.index') }}">AMI</a>
                </li>
                <li class="{{ Route::is('standar*') ? 'active' : '' }}">
                    <a href="{{ route('standar.index') }}">Standar</a>
                </li>
                <li class="{{ Route::is('pertanyaan*') ? 'active' : '' }}">
                    <a href="{{ route('pertanyaan.index') }}">Pertanyaan</a>
                </li>
                <li class="{{ Route::is('nilai*') ? 'active' : '' }}">
                    <a href="{{ route('nilai.index') }}">Nilai</a>
                </li>
                <li class="{{ Route::is('tahun*') ? 'active' : '' }}">
                    <a href="{{ route('tahun.index') }}">Tahun</a>
                </li>
            </ul>
        </li>
        <li class="nav-item dropdown {{ Route::is('laporan*') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown">
                <i class="fas fa-file"></i>
                <span>Laporan</span>
            </a>
            <ul class="dropdown-menu">
                <li class="{{ Route::currentRouteName() == 'laporan.hasil_ami' ? 'active' : '' }}">
                    <a href="{{ route('laporan.hasil_ami') }}">Hasil AMI</a>
                </li>
                <li class="{{ Route::currentRouteName() == 'laporan.temuan_berat' ? 'active' : '' }}">
                    <a href="{{ route('laporan.temuan_berat') }}">Temuan Berat</a>
                </li>
                <li class="{{ Route::currentRouteName() == 'laporan.temuan_ringan' ? 'active' : '' }}">
                    <a href="{{ route('laporan.temuan_ringan') }}">Temuan Ringan</a>
                </li>
            </ul>
        </li>
        @endcan

        @can('auditor')
        <!-- <li class="{{ Route::is('dashboard*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="fas fa-fire"></i>
                <span>Dashboard</span>
            </a>
        </li> -->
        <li class="{{ Route::is('standarpertanyaan.audit') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('standarpertanyaan.audit') }}">
                <i class="fas fa-user"></i>
                <span>Standar & Pertanyaan</span>
            </a>
        </li>
        <li class="{{ Route::is('profile') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('profile') }}">
                <i class="fas fa-user"></i>
                <span>Profil</span>
            </a>
        </li>
        <li class="nav-item dropdown {{ Route::is('laporan*') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown">
                <i class="fas fa-file"></i>
                <span>Laporan</span>
            </a>
            <ul class="dropdown-menu">
                <li class="{{ Route::currentRouteName() == 'laporan.audit.ami' ? 'active' : '' }}">
                    <a href="{{ route('laporan.audit.ami') }}">Hasil AMI</a>
                </li>
                <li class="{{ Route::currentRouteName() == 'laporan.audit.ketercapaian' ? 'active' : '' }}">
                    <a href="{{ route('laporan.audit.ketercapaian') }}">Ketercapaian</a>
                </li>
                <li class="{{ Route::currentRouteName() == 'laporan.audit.ringan' ? 'active' : '' }}">
                    <a href="{{ route('laporan.audit.ringan') }}">Temuan Ringan</a>
                </li>
                <li class="{{ Route::currentRouteName() == 'laporan.audit.berat' ? 'active' : '' }}">
                    <a href="{{ route('laporan.audit.berat') }}">Temuan Berat</a>
                </li>
            </ul>
        </li>
        @endcan

        @can('prodi')
        <li class="{{ Route::is('standarpertanyaan.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('standarpertanyaan.index') }}">
                <i class="fas fa-user"></i>
                <span>Standar & Pertanyaan</span>
            </a>
        </li>
        <li class="{{ Route::is('profile') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('profile') }}">
                <i class="fas fa-user"></i>
                <span>Profil</span>
            </a>
        </li>
        <li class="nav-item dropdown {{ Route::is('laporan*') ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown">
                <i class="fas fa-file"></i>
                <span>Laporan</span>
            </a>
            <ul class="dropdown-menu">
                <li class="{{ Route::currentRouteName() == 'laporan.prodi.ami' ? 'active' : '' }}">
                    <a href="{{ route('laporan.prodi.ami') }}">Hasil AMI</a>
                </li>
                <li class="{{ Route::currentRouteName() == 'laporan.prodi.ketercapaian' ? 'active' : '' }}">
                    <a href="{{ route('laporan.prodi.ketercapaian') }}">Ketercapaian</a>
                </li>
                <li class="{{ Route::currentRouteName() == 'laporan.prodi.ringan' ? 'active' : '' }}">
                    <a href="{{ route('laporan.prodi.ringan') }}">Temuan Ringan</a>
                </li>
                <li class="{{ Route::currentRouteName() == 'laporan.prodi.berat' ? 'active' : '' }}">
                    <a href="{{ route('laporan.prodi.berat') }}">Temuan Berat</a>
                </li>
            </ul>
        </li>
        @endcan

        <li id="menu-logout">
            <a class="nav-link text-danger btn-logout" href="#">
                <i class="fas fa-sign-out-alt"></i>
                <span>Log Out</span>
            </a>
        </li>
    </ul>
</aside>