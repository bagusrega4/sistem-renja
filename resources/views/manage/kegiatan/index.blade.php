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
                                <th>Tanggal</th>
                                <th>Lokasi</th>
                                <th>Deskripsi</th>
                                <th style="width: 150px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kegiatanList as $index => $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_kegiatan }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                                <td>{{ $item->lokasi }}</td>
                                <td>{{ $item->deskripsi }}</td>
                                <td class="text-center">
                                    <!-- Tombol untuk buka modal -->
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalHapus{{ $item->id }}">
                                        Hapus
                                    </button>

                                    <!-- Modal Konfirmasi -->
                                    <div class="modal fade" id="modalHapus{{ $item->id }}" tabindex="-1" aria-labelledby="modalHapusLabel{{ $item->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title" id="modalHapusLabel{{ $item->id }}">Konfirmasi Hapus</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus kegiatan <strong>{{ $item->nama_kegiatan }}</strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <form action="{{ route('manage.kegiatan.destroy', $item->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal -->
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada kegiatan.</td>
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