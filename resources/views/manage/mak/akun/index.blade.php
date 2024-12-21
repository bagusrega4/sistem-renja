@extends('layouts/app')

@section('content')
<div class="container">
    <div class="page-inner">
        <div
            class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h2 class="fw-bold mb-3">Kelola Mata Anggaran Keuangan</h2>
                <h6 class="op-7 mb-2">Mengelola Mata Anggaran Keuangan Akun Belanja Sistem Bukti Dukung Administrasi BPS Provinsi DKI Jakarta</h6>
            </div>
            <div class="ms-md-auto py-2 py-md-0">
                <a href="{{ route('manage.mak.akun.create') }}" class="btn btn-primary btn-round">Tambah Akun Belanja</a>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card card-round">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                        <div class="card-title">Daftar Akun Belanja</div>
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
                        <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kode</th>
                                    <th>Nama Akun</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($accounts as $account)
                                    <tr>
                                        <th scope="row">
                                            {{ $loop->iteration }}
                                        </th>
                                        <td class="text-start">{{ $account->kode }}</td>
                                        <td class="text-start">{{ $account->akun_belanja }}</td>
                                        <td>
                                            <div class="btn-group dropdown">
                                                <button
                                                    class="btn {{ $account->flag == 1 ? 'btn-outline-success' : 'btn-outline-danger' }} dropdown-toggle"
                                                    type="button"
                                                    data-bs-toggle="dropdown"
                                                    data-id="{{ $account->id }}"
                                                    data-flag="{{ $account->flag }}"
                                                    data-akun="{{ $account->akun_belanja }}"
                                                >
                                                    {{ $account->flag == 1 ? 'Tampilkan' : 'Jangan Tampilkan' }}
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li>
                                                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#confirmModal" data-id="{{ $account->id }}" data-flag="1" data-akun="{{ $account->akun_belanja }}">Tampilkan</button>
                                                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#confirmModal" data-id="{{ $account->id }}" data-flag="0" data-akun="{{ $account->akun_belanja }}">Jangan Ditampilkan</button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
                Apakah Anda yakin ingin <span id="modal-action-text"></span> akun "<span id="modal-akun-belanja"></span>"?
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
    const confirmModal = document.getElementById('confirmModal');
    confirmModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const id = button.getAttribute('data-id');
        const flag = button.getAttribute('data-flag');
        const akunBelanja = button.getAttribute('data-akun');
        const actionText = flag == "1" ? "menampilkan" : "tidak menampilkan";

        const modalActionText = confirmModal.querySelector('#modal-action-text');
        const modalFlag = confirmModal.querySelector('#modal-flag');
        const modalForm = confirmModal.querySelector('#modalForm');
        const modalAkunBelanja = confirmModal.querySelector('#modal-akun-belanja');

        modalActionText.textContent = actionText;
        modalFlag.value = flag;
        modalForm.action = `/manage/mak/akun/${id}/update-flag`;
        modalAkunBelanja.textContent = akunBelanja;
    });
</script>
@endsection
