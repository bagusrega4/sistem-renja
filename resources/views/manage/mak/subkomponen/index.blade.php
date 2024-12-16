@extends('layouts/app')

@section('content')
<div class="container">
    <div class="page-inner">
        <!-- Notifikasi Sukses -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h2 class="fw-bold mb-3">Kelola Mata Anggaran Keuangan</h2>
                <h6 class="op-7 mb-2">Mengelola Mata Anggaran Keuangan tabel Sub Komponen</h6>
            </div>
            <div class="ms-md-auto py-2 py-md-0">
                <a href="{{ route('manage.mak.subkomponen.create') }}" class="btn btn-primary btn-round">Tambah Sub Komponen</a>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card card-round">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                        <div class="card-title">Tabel Sub Komponen</div>
                        <div class="card-tools">
                            <div class="dropdown">
                                <button
                                    class="btn btn-icon btn-clean me-0"
                                    type="button"
                                    id="dropdownMenuButton"
                                    data-bs-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="fas fa-filter"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">Range Tanggal</a>
                                    <a class="dropdown-item" href="#">Akun Belanja</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <!-- Tabel Sub Komponen -->
                        <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kode</th>
                                    <th>Sub Komponen</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subcomponents as $subcomponent)
                                    <tr>
                                        <th scope="row">
                                            {{ $loop->iteration }}
                                        </th>
                                        <td class="text-start">{{ $subcomponent->kode }}</td>
                                        <td class="text-start">{{ $subcomponent->sub_komponen }}</td>
                                        <td>
                                            <div class="btn-group dropdown">
                                                <button
                                                    class="btn btn-warning dropdown-toggle"
                                                    type="button"
                                                    data-bs-toggle="dropdown">
                                                    {{ $subcomponent -> flag == 1 ? 'Tampilkan' : 'Jangan Tampilkan' }}
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li>
                                                        <a class="dropdown-item" href="#">Tampilkan</a>
                                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#changeFlagModalCenter{{ $loop->iteration }}" href="#">Jangan Tampilkan</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Modal Ubah Flag -->
                                    <div class="modal fade" id="changeFlagModalCenter{{ $loop->iteration }}" tabindex="-1" aria-labelledby="changeFlagModalCenterLabel{{ $loop->iteration }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="changeFlagModalCenterLabel{{ $loop->iteration }}">Ubah Flag</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Konten Modal: Konfirmasi Ubah Flag -->
                                                    Apakah Anda yakin ingin mengubah flag untuk sub komponen "{{ $subcomponent->sub_komponen }}"?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                                    <form action="{{ route('manage.mak.subkomponen.updateFlag', $subcomponent->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- Akhir Tabel Sub Komponen -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
