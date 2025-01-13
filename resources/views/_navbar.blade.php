<div class="main-header">
    <div class="main-header-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
                <img src="{{ asset('assets/img/kaiadmin/logo_light.svg') }}" alt="navbar brand" class="navbar-brand"
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
    <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
        <div class="container-fluid">
            <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                <li class="nav-item topbar-icon dropdown hidden-caret">
                    <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-bell"></i>
                        <span class="notification">{{ $pengajuanSelesai->count() + $pengajuanDitolak->count() }}</span>
                    </a>
                    <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown"
                        style="width: 350px; overflow-y: auto; overflow-x: hidden; max-height: 400px;">
                        <li>
                            <div class="dropdown-title">
                                You have {{ $pengajuanSelesai->count() + $pengajuanDitolak->count() }} new notifications
                            </div>
                        </li>
                        <li>
                            <div class="notif-scroll scrollbar-outer">
                                <div class="notif-center">
                                    <!-- Pengajuan Selesai -->
                                    @foreach ($pengajuanSelesai as $pengajuan)
                                        <a class="d-flex align-items-center mb-2 clickable" data-bs-toggle="modal"
                                            data-bs-target="#viewModalCenter{{ $pengajuan->id }}">
                                            <div class="notif-icon rounded-circle bg-success d-flex justify-content-center align-items-center flex-shrink-0"
                                                style="width: 36px; height: 36px;">
                                                <i class="fa fa-check"></i>
                                            </div>
                                            <div class="notif-content ms-3 flex-grow-1">
                                                <span class="block fw-bold text-truncate"
                                                    style="max-width: 260px;">{{ $pengajuan->uraian }}</span>
                                                <span class="time text-muted">No. FP: {{ $pengajuan->no_fp }}</span>
                                            </div>
                                        </a>
                                    @endforeach

                                    <!-- Pengajuan Ditolak -->
                                    @foreach ($pengajuanDitolak as $pengajuan)
                                        <a class="d-flex align-items-center mb-2 clickable" data-bs-toggle="modal"
                                            data-bs-target="#viewModalCenter{{ $pengajuan->id }}">
                                            <div class="notif-icon rounded-circle bg-danger d-flex justify-content-center align-items-center flex-shrink-0"
                                                style="width: 36px; height: 36px;">
                                                <i class="fa fa-times"></i>
                                            </div>
                                            <div class="notif-content ms-3 flex-grow-1">
                                                <span class="block fw-bold text-truncate"
                                                    style="max-width: 260px;">{{ $pengajuan->uraian }}</span>
                                                <span class="time text-muted">No. FP: {{ $pengajuan->no_fp }}</span>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </li>
                        <button type="button" class="btn btn-see-all" data-bs-toggle="modal"
                            data-bs-target="#exampleModalCenter">
                            See all notifications <i class="fa fa-angle-right"></i>
                        </button>
                    </ul>
                </li>
                <li class="nav-item topbar-user dropdown hidden-caret">
                    <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#"
                        aria-expanded="false">
                        <div class="avatar-sm">
                            @if (Auth::user())
                                <img src="{{ !Auth::user()->photo ? 'https://www.gravatar.com/avatar/00000000000000000000000000000000?d=mp&f=y' : asset('/storage/' . Auth::user()->photo) }}"
                                    alt="..." class="avatar-img rounded-circle" />
                            @endif
                        </div>
                        <span class="profile-username">
                            <span class="op-7">Hi,</span>
                            @if (Auth::user())
                                <span class="fw-bold">{{ Auth::user()->username }}</span>
                            @endif
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                        <div class="dropdown-user-scroll scrollbar-outer">
                            <li>
                                <div class="user-box">
                                    <div class="avatar-lg">
                                        @if (Auth::user())
                                            <img src="{{ !Auth::user()->photo ? 'https://www.gravatar.com/avatar/00000000000000000000000000000000?d=mp&f=y' : asset('/storage/' . Auth::user()->photo) }}"
                                                alt="..." class="avatar-img rounded-circle" />
                                        @endif
                                    </div>
                                    <div class="u-text">
                                        @if (Auth::user())
                                            <h4 class="text-capitalize">{{ Auth::user()->username }}</h4>
                                            <p class="text-muted">{{ Auth::user()->email }}</p>
                                            <p class="text-muted text-capitalize">as {{ Auth::user()->role->role }}</p>
                                        @endif
                                        <a href="{{ route('profile.edit') }}" class="btn btn-xs btn-primary btn-sm">
                                            {{ __('View Profile') }}
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item logout-btn cursor-pointer" :href="route('logout')"
                                        onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </button>
                                </form>
                            </li>
                        </div>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</div>

<style>
    .logout-btn:hover {
        background-color: #dc3545 !important;
        color: #fff !important;
    }
</style>


<!-- Modal View -->
@foreach ($pengajuanSelesai->concat($pengajuanDitolak) as $fp)
    <div class="modal fade" id="viewModalCenter{{ $fp->id }}" tabindex="-1" role="dialog"
        aria-labelledby="viewModalCenterTitle{{ $fp->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalCenterTitle">View Pengajuan</h5>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No. FP</th>
                                    <th>Nama Permintaan</th>
                                    <th>Rincian Output</th>
                                    <th>Komponen</th>
                                    <th>Sub Komponen</th>
                                    <th>Akun</th>
                                    <th>Tanggal Kegiatan</th>
                                    <th>No. SK</th>
                                    <th>Nominal</th>
                                    <th>Catatan</th>
                                    <th>Bukti Transfer</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-start">{{ $fp->no_fp }}</td>
                                    <td class="text-start"><strong>{{ $fp->uraian }}</strong></td>
                                    <td class="text-start">
                                        [{{ $fp->output->kegiatan->kode }}.{{ $fp->output->kro->kode }}.{{ $fp->output->kode_ro }}]
                                        {{ $fp->output->output }}</td>
                                    <td class="text-start">{{ $fp->komponen->komponen }}</td>
                                    <td class="text-start">{{ $fp->subKomponen->sub_komponen }}</td>
                                    <td class="text-start">{{ $fp->akunBelanja->nama_akun }}</td>
                                    <td class="text-start">{{ $fp->tanggal_mulai }} s.d. {{ $fp->tanggal_akhir }}
                                    </td>
                                    <td class="text-start">{{ $fp->no_sk }}</td>
                                    <td class="text-start nominal-currency">{{ $fp->nominal }}</td>
                                    <td class="text-center">{{ $fp->rejection_note ?? '-' }}</td>
                                    <td class="text-start">
                                        <button type="button" class="btn btn-primary btn-sm me-2"
                                            data-bs-toggle="modal" data-bs-target="#previewModal"
                                            title="Preview Bukti Pengajuan">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
