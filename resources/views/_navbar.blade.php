<div class="main-header">
    <div class="main-header-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
                <img
                    src="assets/img/kaiadmin/logo_light.svg"
                    alt="navbar brand"
                    class="navbar-brand"
                    height="20" />
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
    <!-- Navbar Header -->
    <nav
        class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
        <div class="container-fluid">
            <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                <li class="nav-item topbar-icon dropdown hidden-caret">
                    <a
                        class="nav-link dropdown-toggle"
                        href="#"
                        id="notifDropdown"
                        role="button"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false">
                        <i class="fa fa-bell"></i>
                        <span class="notification">2</span>
                    </a>
                    <ul
                        class="dropdown-menu notif-box animated fadeIn"
                        aria-labelledby="notifDropdown">
                        <li>
                            <div class="dropdown-title">
                                You have 2 new notification
                            </div>
                        </li>
                        <li>
                            <div class="notif-scroll scrollbar-outer">
                                <div class="notif-center">
                                    <a data-bs-toggle="modal" data-bs-target="#accModalCenter">
                                        <div class="notif-icon notif-success">
                                            <i class="fa fa-check"></i>
                                        </div>
                                        <div class="notif-content">
                                            <span class="block">Supervisi Sakernas</span> <!-- Nama Pengajuan -->
                                            <span class="time">No. FP: 195</span>
                                        </div>
                                    </a>
                                    <a data-bs-toggle="modal" data-bs-target="#tolakModalCenter">
                                        <div class="notif-icon notif-danger">
                                            <i class="fa fa-times"></i>
                                        </div>
                                        <div class="notif-content">
                                            <span class="block">
                                                Supervisi Sensus Penduduk
                                            </span>
                                            <span class="time">No. FP: 175</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <button type="button" class="btn btn-see-all" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
                            See all notifications <i class="fa fa-angle-right"></i>
                        </button>
                    </ul>
                </li>
                <li class="nav-item topbar-user dropdown hidden-caret">
                    <a
                        class="dropdown-toggle profile-pic"
                        data-bs-toggle="dropdown"
                        href="#"
                        aria-expanded="false">
                        <div class="avatar-sm">
                            <img
                                src="assets/img/profile.png"
                                alt="..."
                                class="avatar-img rounded-circle" />
                        </div>
                        <span class="profile-username">
                            <span class="op-7">Hi,</span>
                            <span class="fw-bold">Agape</span>
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                        <div class="dropdown-user-scroll scrollbar-outer">
                            <li>
                                <div class="user-box">
                                    <div class="avatar-lg">
                                        <img
                                            src="assets/img/profile.png"
                                            alt="image profile"
                                            class="avatar-img rounded" />
                                    </div>
                                    <div class="u-text">
                                        <h4>Agape Bagus Rega Anggara</h4>
                                        <p class="text-muted">bagusrega4@gmail.com</p>
                                        <p class="text-muted">as Admin</p>
                                        <a
                                            href="profile.html"
                                            class="btn btn-xs btn-secondary btn-sm">View Profile</a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Logout</a>
                            </li>
                        </div>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</div>