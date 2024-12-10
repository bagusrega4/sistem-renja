<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo d-flex align-items-center">
                <img
                    src="../assets/img/kaiadmin/logo_bps.png"
                    alt="navbar brand"
                    class="navbar-brand"
                    height="30" />
                <span class="ms-1 text-white fw-bold">DKI Jakarta</span> <!-- Tulisan DKI Jakarta -->
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
                <li class="nav-item active">
                    <a href="dashboard_admin.html">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Components</h4>
                </li>
                <li class="nav-item">
                    <a href="/form">
                        <i class="fas fa-file"></i>
                        <p>Form</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#base">
                        <i class="fas fa-desktop"></i>
                        <p>Monitoring</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="base">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="/monitoring/operator">
                                    <span class="sub-item">Operator</span>
                                </a>
                            </li>
                            <li>
                                <a href="/monitoring/keuangan">
                                    <span class="sub-item">Keuangan</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="/download">
                        <i class="fas fa-download"></i>
                        <p>Download</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Settings</h4>
                </li>
                <li class="nav-item">
                    <a href="/manage/user">
                        <i class="fas fa-users-cog"></i>
                        <p>Manage User</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#flag">
                        <i class="fas fa-flag"></i>
                        <p>Manage Flag</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="flag">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="/manage/mak/akun">
                                    <span class="sub-item">Akun</span>
                                </a>
                            </li>
                            <li>
                                <a href="/manage/mak/komponen">
                                    <span class="sub-item">Komponen</span>
                                </a>
                            </li>
                            <li>
                                <a href="/manage/mak/subkomponen">
                                    <span class="sub-item">Subkomponen</span>
                                </a>
                            </li>
                            <li>
                                <a href="/manage/mak/output">
                                    <span class="sub-item">Output</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="/manage/form">
                        <i class="fas fa-pen-square"></i>
                        <p>Manage Form</p>
                    </a>
                </li>
                <style>
                    .nav-item a .badge-success {
                        margin-right: 0;
                        /* Remove space on the right side of the first badge */
                    }

                    .nav-item a .badge-danger {
                        margin-left: 2px;
                        /* Adjust this value to control the spacing between badges */
                    }
                </style>
            </ul>
        </div>
    </div>
</div>
