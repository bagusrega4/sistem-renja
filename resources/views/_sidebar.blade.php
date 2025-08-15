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
                    Badan Pusat Statistik Kabupaten Kediri
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
                        </ul>
                    </div>
                </li>
                @endif
                <li class="nav-item {{ request()->routeIs('manage.kegiatan.*') ? 'active' : '' }}">
                    <a href="{{ route('manage.kegiatan.index') }}">
                        <i class="fas fa-tasks"></i>
                        <p>Manage Kegiatan</p>
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