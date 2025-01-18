<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="/" class="logo d-flex align-items-center">
                <img
                    src="{{ asset('assets/img/logo.png') }}"
                    alt="navbar brand"
                    class="navbar-brand"
                    height="25" />
                <span
                    style="font-family: Arial, sans-serif; font-size:11px; line-height:1.2;"
                    class="fw-bold fst-italic text-uppercase text-white">
                    Badan Pusat Statistik Provinsi DKI Jakarta
                </span>

            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Menu</h4>
                </li>
                <li class="nav-item {{ request()->routeIs('form.*') ? 'active' : '' }}">
                    <a href="{{ route('form.index') }}">
                        <i class="fas fa-file"></i>
                        <p>Form</p>
                    </a>
                </li>
                @if(Auth::user()->id_role == 1)
                <li class="nav-item {{ request()->routeIs('monitoring.*') ? 'active' : '' }}">
                    <a href="{{ route('monitoring.operator.index') }}">
                        <i class="fas fa-desktop"></i>
                        <p>Monitoring</p>
                    </a>
                </li>
                @else
                <li class="nav-item {{ request()->routeIs('monitoring.*') ? 'active submenu' : '' }}">
                    <a data-bs-toggle="collapse" href="#base">
                        <i class="fas fa-desktop"></i>
                        <p>Monitoring</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('monitoring.*') ? 'show' : '' }}" id="base">
                        <ul class="nav nav-collapse">
                            <li class="{{ request()->routeIs('monitoring.operator.*') ? 'active' : '' }}">
                                <a href="{{ route('monitoring.operator.index') }}">
                                    <span class="sub-item">Operator</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('monitoring.keuangan.*') ? 'active' : '' }}">
                                <a href="{{ route('monitoring.keuangan.index') }}">
                                    <span class="sub-item">Keuangan</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endif
                <li class="nav-item {{ request()->routeIs('download.index') ? 'active' : '' }}">
                    <a href="{{ route('download.index') }}">
                        <i class="fas fa-download"></i>
                        <p>Download</p>
                    </a>
                </li>
                @if(Auth::user()->id_role == 3)
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Settings</h4>
                </li>
                <li class="nav-item {{ request()->routeIs('manage.user.*') || request()->routeIs('manage.user.create') || request()->routeIs('manage.user.edit') ? 'active' : '' }}">
                    <a href="{{ route('manage.user.index') }}">
                        <i class="fas fa-users-cog"></i>
                        <p>Manage User</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('manage.mak.*') ? 'active submenu' : '' }}">
                    <a data-bs-toggle="collapse" href="#flag">
                        <i class="fas fa-flag"></i>
                        <p>Manage MAK</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('manage.mak.*') ? 'show' : '' }}" id="flag">
                        <ul class="nav nav-collapse">
                            <li class="{{ request()->routeIs('manage.mak.akun') || request()->routeIs('manage.mak.akun.create') || request()->routeIs('manage.mak.akun.edit') ?  'active' : '' }}">
                                <a href="{{ route('manage.mak.akun') }}">
                                    <span class="sub-item">Akun</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('manage.mak.komponen') || request()->routeIs('manage.mak.komponen.create') ? 'active' : '' }}">
                                <a href="{{ route('manage.mak.komponen') }}">
                                    <span class="sub-item">Komponen</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('manage.mak.subkomponen') || request()->routeIs('manage.mak.subkomponen.create') ? 'active' : '' }}">
                                <a href="{{ route('manage.mak.subkomponen') }}">
                                    <span class="sub-item">Sub Komponen</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('manage.mak.kegiatan') || request()->routeIs('manage.mak.kegiatan.create') ? 'active' : '' }}">
                                <a href="{{ route('manage.mak.kegiatan') }}">
                                    <span class="sub-item">Kegiatan</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('manage.mak.kro') || request()->routeIs('manage.mak.kro.create') ? 'active' : '' }}">
                                <a href="{{ route('manage.mak.kro') }}">
                                    <span class="sub-item">KRO</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('manage.mak.output') || request()->routeIs('manage.mak.output.create') ? 'active' : '' }}">
                                <a href="{{ route('manage.mak.output') }}">
                                    <span class="sub-item">Output</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endif
                <li class="nav-item {{ request()->routeIs('panduan.index') ? 'active' : '' }}">
                    <a href="{{ route('panduan.index') }}">
                        <i class="fas fa-book"></i>
                        <p>Panduan</p>
                    </a>
                </li>
                <style>
                    .nav-item a .badge-success {
                        margin-right: 0;
                    }

                    .nav-item a .badge-danger {
                        margin-left: 2px;
                    }
                </style>
            </ul>
        </div>
    </div>
</div>
