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

        <div
            class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h2 class="fw-bold mb-3">Kelola Pengguna</h2>
                <h6 class="op-7 mb-2">Pengelolaan Daftar Pengguna Sistem Bukti Dukung Administrasi BPS Provinsi DKI Jakarta</h6>
            </div>
            <div class="ms-md-auto py-2 py-md-0">
                <a href="{{ route('manage.user.create') }}" class="btn btn-primary btn-round">Tambah User</a>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card card-round">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                        <div class="card-title">Daftar Pengguna</div>
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
                        <!-- Tabel Manage User -->
                        <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>NIP Lama</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $user->nip_lama }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <!-- Button untuk membuka modal -->
                                            <button
                                                class="btn {{ $user->role == 'admin' ? 'btn-secondary' : ($user->role == 'keuangan' ? 'btn-primary' : 'btn-info') }} dropdown-toggle"
                                                type="button"
                                                data-bs-toggle="dropdown"
                                                data-id="{{ $user->id }}"
                                                data-role="{{ $user->role }}"
                                                data-username="{{ $user->username }}">
                                                {{ ucfirst($user->role) }}
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li>
                                                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#confirmModal" data-id="{{ $user->id }}" data-role="user" data-username="{{ $user->username }}">User</button>
                                                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#confirmModal" data-id="{{ $user->id }}" data-role="keuangan" data-username="{{ $user->username }}">Keuangan</button>
                                                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#confirmModal" data-id="{{ $user->id }}" data-role="admin" data-username="{{ $user->username }}">Admin</button>
                                                </li>
                                            </ul>
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
                <h5 class="modal-title">Konfirmasi Ubah Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin mengubah role untuk user "<span id="modal-username"></span>" menjadi "<span id="modal-new-role"></span>"?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                <form id="modalForm" method="POST" style="display: inline;">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="role" id="modal-role">
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
        const modalUsername = confirmModal.querySelector('#modal-username');
        const modalNewRole = confirmModal.querySelector('#modal-new-role');
        const modalRole = confirmModal.querySelector('#modal-role');

        const updateRoleRoutePattern = "{{ route('manage.user.updateRole', ':id') }}";

        confirmModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const newRole = button.getAttribute('data-role');
            const username = button.getAttribute('data-username');

            modalUsername.textContent = username;
            modalNewRole.textContent = newRole.charAt(0).toUpperCase() + newRole.slice(1);
            modalRole.value = newRole;
            modalForm.action = updateRoleRoutePattern.replace(':id', id);
        });
    });
</script>
@endsection
