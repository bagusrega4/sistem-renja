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
                <h6 class="op-7 mb-2">Pengelolaan Mata Anggaran Keuangan Sub Komponen Sistem Bukti Dukung Administrasi BPS Provinsi DKI Jakarta</h6>
            </div>
            <div class="ms-md-auto py-2 py-md-0">
                <a href="{{ route('manage.mak.subkomponen.create') }}" class="btn btn-primary btn-round">Tambah Sub Komponen</a>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card card-round">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                        <div class="card-title">Daftar Sub Komponen</div>
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
                                                    class="btn {{ $subcomponent->flag == 1 ? 'btn-outline-success' : 'btn-outline-danger' }} dropdown-toggle"
                                                    type="button"
                                                    data-bs-toggle="dropdown"
                                                    data-id="{{ $subcomponent->id }}"
                                                    data-flag="{{ $subcomponent->flag }}"
                                                    data-subkomponen="{{ $subcomponent->sub_komponen }}">
                                                    {{ $subcomponent->flag == 1 ? 'Tampilkan' : 'Jangan Tampilkan' }}
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li>
                                                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#confirmModal" data-id="{{ $subcomponent->id }}" data-flag="1" data-subkomponen="{{ $subcomponent->sub_komponen }}">Tampilkan</button>
                                                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#confirmModal" data-id="{{ $subcomponent->id }}" data-flag="0" data-subkomponen="{{ $subcomponent->sub_komponen }}">Jangan Ditampilkan</button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
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

<!-- Modal Konfirmasi -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Ubah Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin <span id="modal-action-text"></span> sub komponen "<span id="modal-subkomponen"></span>"?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                <form id="modalForm" method="POST" style="display: inline;">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="flag" id="modal-flag">
                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const confirmModal = document.getElementById('confirmModal');
        const modalForm = confirmModal.querySelector('#modalForm');
        const modalActionText = confirmModal.querySelector('#modal-action-text');
        const modalSubkomponen = confirmModal.querySelector('#modal-subkomponen');
        const modalFlag = confirmModal.querySelector('#modal-flag');

        const updateFlagRoutePattern = "{{ route('manage.mak.subkomponen.updateFlag', ':id') }}";

        confirmModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const flag = button.getAttribute('data-flag');
            const subkomponen = button.getAttribute('data-subkomponen');

            const actionText = flag == "1" ? "menampilkan" : "tidak menampilkan";

            modalActionText.textContent = actionText;
            modalFlag.value = flag;
            modalSubkomponen.textContent = subkomponen;
            modalForm.action = updateFlagRoutePattern.replace(':id', id);
        });
    });
</script>
@endsection
