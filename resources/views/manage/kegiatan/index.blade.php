@extends('layouts.app')

@section('content')
<div class="container">
    <div class="page-inner">

        {{-- Notifikasi Error Custom --}}
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm rounded px-3 py-2" role="alert" style="border-left: 5px solid #dc3545;">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        {{-- Notifikasi Validasi Error --}}
        @if ($errors->any())
        <div class="alert alert-danger shadow-sm rounded px-3 py-2" role="alert" style="border-left: 5px solid #dc3545;">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- Notifikasi Sukses --}}
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm rounded w-100 mb-3"
            role="alert"
            style="border-left: 5px solid #28a745; padding: 0.75rem 1rem; display: flex; align-items: center; justify-content: space-between;">
            <span class="me-3">{{ session('success') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="margin: 0;"></button>
        </div>
        @endif

        {{-- Card Daftar Kegiatan --}}
        <div class="card card-round">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">Manage Kegiatan</h4>

                {{-- Tombol Tambah Kegiatan hanya untuk selain role 3 --}}
                @if(auth()->user()->id_role != 3)
                <a href="{{ route('manage.kegiatan.create') }}" class="btn btn-primary btn-sm">+ Tambah Kegiatan</a>
                @endif
            </div>
            <div class="card-body">

                {{-- FILTER --}}
                <div class="mb-3">
                    <form method="GET" action="{{ route('manage.kegiatan.index') }}">
                        <div class="row g-3">
                            {{-- Nama Tim (khusus role 3) --}}
                            @if(auth()->user()->id_role == 3)
                            <div class="col">
                                <label for="tim_id" class="form-label">Nama Tim</label>
                                <select name="tim_id" id="tim_id" class="form-select">
                                    <option value="" disabled {{ request('tim_id') ? '' : 'selected' }}>Pilih Tim</option>
                                    @foreach($timList as $tim)
                                    <option value="{{ $tim->id }}" {{ request('tim_id') == $tim->id ? 'selected' : '' }}>
                                        {{ $tim->nama_tim }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            @endif

                            {{-- Nama Kegiatan --}}
                            <div class="col">
                                <label for="nama_kegiatan" class="form-label">Nama Kegiatan</label>
                                <input type="text" name="nama_kegiatan" id="nama_kegiatan"
                                    value="{{ request('nama_kegiatan') }}"
                                    class="form-control"
                                    placeholder="Cari kegiatan...">
                            </div>

                            {{-- Periode Mulai --}}
                            <div class="col">
                                <label for="periode_mulai" class="form-label">Periode Mulai</label>
                                <input type="date" name="periode_mulai" id="periode_mulai"
                                    value="{{ request('periode_mulai') }}"
                                    class="form-control">
                            </div>

                            {{-- Periode Selesai --}}
                            <div class="col">
                                <label for="periode_selesai" class="form-label">Periode Selesai</label>
                                <input type="date" name="periode_selesai" id="periode_selesai"
                                    value="{{ request('periode_selesai') }}"
                                    class="form-control">
                            </div>

                            {{-- Status --}}
                            <div class="col">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-select">
                                    <option value="" {{ request('status') == '' ? 'selected' : '' }}>Semua</option>
                                    <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>
                            </div>

                            <div class="col-auto d-flex align-items-end">
                                <button type="submit" class="btn btn-primary me-2">Filter</button>
                                <a href="{{ route('manage.kegiatan.index') }}" class="btn btn-secondary">Reset</a>
                            </div>
                        </div>
                    </form>
                </div>
                {{-- END FILTER --}}

                @if($kegiatanList->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama Kegiatan</th>
                                <th>Periode</th>
                                <th>Deskripsi</th>
                                @if(auth()->user()->id_role == 3)
                                <th>Nama Tim</th>
                                @endif
                                <th>Status</th>
                                <th style="width: 150px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kegiatanList as $item)
                            <tr>
                                <td class="text-center">
                                    {{ ($kegiatanList->currentPage() - 1) * $kegiatanList->perPage() + $loop->iteration }}
                                </td>
                                <td>{{ $item->nama_kegiatan }}</td>
                                <td>
                                    @if($item->periode_mulai && $item->periode_selesai)
                                    {{ \Carbon\Carbon::parse($item->periode_mulai)->translatedFormat('d F Y') }}
                                    -
                                    {{ \Carbon\Carbon::parse($item->periode_selesai)->translatedFormat('d F Y') }}
                                    @else
                                    <em>Belum diatur</em>
                                    @endif
                                </td>
                                <td>{{ $item->deskripsi ?? '-' }}</td>

                                @if(auth()->user()->id_role == 3)
                                <td class="text-center">
                                    {{ $item->tim->nama_tim ?? '-' }}
                                </td>
                                @endif

                                <td class="text-center">
                                    @if($item->status == 'selesai')
                                    <span class="badge bg-success">Selesai</span>
                                    @else
                                    <span class="badge bg-primary">Aktif</span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    @if(auth()->user()->id_role != 3)
                                    @if($item->status != 'selesai')
                                    <form action="{{ route('manage.kegiatan.selesai', $item->id) }}"
                                        method="POST"
                                        onsubmit="return confirmSelesai(this, '{{ $item->nama_kegiatan }}')">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-success btn-sm">
                                            Selesai
                                        </button>
                                    </form>
                                    @else
                                    <button class="btn btn-success btn-sm"
                                        onclick="return false;"
                                        style="cursor: not-allowed; opacity: 0.65;">
                                        Selesai
                                    </button>
                                    @endif
                                    @else
                                    <button class="btn btn-success btn-sm"
                                        onclick="return false;"
                                        style="cursor: not-allowed; opacity: 0.65;">
                                        Selesai
                                    </button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <form method="GET" action="{{ route('manage.kegiatan.index') }}">
                                {{-- Bawa semua filter lama agar tidak hilang --}}
                                <input type="hidden" name="tim_id" value="{{ request('tim_id') }}">
                                <input type="hidden" name="nama" value="{{ request('nama') }}">
                                <input type="hidden" name="kegiatan" value="{{ request('kegiatan') }}">
                                <input type="hidden" name="periode_mulai" value="{{ request('periode_mulai') }}">
                                <input type="hidden" name="periode_selesai" value="{{ request('periode_selesai') }}">

                                <label for="per_page" class="form-label">Tampilkan</label>
                                <select name="per_page" id="per_page" class="form-select d-inline-block w-auto"
                                    onchange="this.form.submit()">
                                    <option value="5" {{ request('per_page') == 5  ? 'selected' : '' }}>5</option>
                                    <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                    <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                </select>
                                <span>data per halaman</span>
                            </form>
                        </div>

                        {{-- Pagination --}}
                        <div>
                            {{ $kegiatanList->withQueryString()->links() }}
                        </div>
                    </div>
                    @else
                    <div class="text-center py-5">
                        <h6 class="text-muted mb-3">Belum ada kegiatan yang ditambahkan.</h6>

                        {{-- Tombol tambah kegiatan hanya untuk selain role 3 --}}
                        @if(auth()->user()->id_role != 3)
                        <a href="{{ route('manage.kegiatan.create') }}" class="btn btn-primary">
                            + Tambah Kegiatan Pertama
                        </a>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endsection

    @push('scripts')
    <style>
        .swal2-actions .btn {
            margin: 0 8px;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmSelesai(form, namaKegiatan) {
            event.preventDefault();

            Swal.fire({
                title: `Tandai kegiatan "${namaKegiatan}" sebagai selesai?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Selesai',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-secondary'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });

            return false;
        }

        setTimeout(() => {
            let alert = document.querySelector('.alert-dismissible');
            if (alert) {
                let bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }
        }, 10000);

        @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: @json(session('success')),
            timer: 3000,
            showConfirmButton: false
        });
        @endif
    </script>
    @endpush