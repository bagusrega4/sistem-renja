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
                <h2 class="fw-bold mb-3">Manage User</h2>
                <h6 class="op-7 mb-2">Manage akun BPS Provinsi DKI Jakarta</h6>
            </div>
            <div class="ms-md-auto py-2 py-md-0">
                <a href="{{ route('manage.user.create') }}" class="btn btn-primary btn-round">Tambah User</a>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card card-round">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                        <div class="card-title">Tabel Manage User</div>
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
                        <!-- Projects table -->
                        <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>NIP Lama</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $user->niplama }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->password }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <!-- Button untuk membuka modal -->
                                            <button 
                                                class="btn btn-warning dropdown-toggle"
                                                type="button"
                                                data-bs-toggle="dropdown">
                                                {{ $user->role }}
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li>
                                                    <form action="{{ route('manage.user.updateRole', $user->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="role" value="User">
                                                        <button type="submit" class="dropdown-item">User</button>
                                                    </form>
                                                    <form action="{{ route('manage.user.updateRole', $user->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="role" value="Keuangan">
                                                        <button type="submit" class="dropdown-item">Keuangan</button>
                                                    </form>
                                                    <form action="{{ route('manage.user.updateRole', $user->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="role" value="Admin">
                                                        <button type="submit" class="dropdown-item">Admin</button>
                                                    </form>
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
@endsection