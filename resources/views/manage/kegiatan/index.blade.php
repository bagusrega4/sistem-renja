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
                <a href="{{ route('manage.kegiatan.create') }}" class="btn btn-primary btn-sm">+ Tambah Kegiatan</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama Kegiatan</th>
                                <th>Periode</th>
                                <th>Deskripsi</th>
                                <th>Status</th>
                                <th style="width: 150px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kegiatanList as $index => $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
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
                                <td>{{ $item->deskripsi }}</td>
                                <td class="text-center">
                                    @if($item->status == 'selesai')
                                    <span class="badge bg-success">Selesai</span>
                                    @else
                                    <span class="badge bg-primary">Aktif</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('manage.kegiatan.selesai', $item->id) }}" method="POST" onsubmit="return confirmSelesai(this, '{{ $item->nama_kegiatan }}')">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-success btn-sm">Selesai</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">Belum ada kegiatan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<style>
    /* Tambahkan jarak antar tombol di SweetAlert */
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

    // Auto close alert Bootstrap setelah 10 detik
    setTimeout(() => {
        let alert = document.querySelector('.alert-dismissible');
        if (alert) {
            let bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }
    }, 10000); // 10 detik

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