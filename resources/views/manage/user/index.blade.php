@extends('layouts/app')
@section('content')
<div class="container">
    <div class="page-inner">
        <div
            class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h2 class="fw-bold mb-3">Manage User</h2>
                <h6 class="op-7 mb-2">Manage akun BPS Provinsi DKI Jakarta</h6>
            </div>
            <div class="ms-md-auto py-2 py-md-0">
                <a href="form_add_user.html" class="btn btn-primary btn-round">Tambah User</a>
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
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Ubah Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">
                                        1
                                    </th>
                                    <td class="text-start">heryanah</td>
                                    <td class="text-start">heryanah@bps.go.id</td>
                                    <td class="text-start">
                                        <span class="badge badge-warning">User</span>
                                    </td>
                                    <td>
                                        <div class="btn-group dropdown">
                                            <button
                                                class="btn btn-warning dropdown-toggle"
                                                type="button"
                                                data-bs-toggle="dropdown">
                                                User
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li>
                                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ubahRoleModalCenter" href="#">User</a>
                                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ubahRoleModalCenter" href="#">Keuangan</a>
                                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ubahRoleModalCenter" href="#">Admin</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        2
                                    </th>
                                    <td class="text-start">aprie</td>
                                    <td class="text-start">aprie@bps.go.id</td>
                                    <td class="text-start">
                                        <span class="badge badge-primary">Keuangan</span>
                                    </td>
                                    <td>
                                        <div class="btn-group dropdown">
                                            <button
                                                class="btn btn-primary dropdown-toggle"
                                                type="button"
                                                data-bs-toggle="dropdown">
                                                Keuangan
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li>
                                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ubahRoleModalCenter" href="#">User</a>
                                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ubahRoleModalCenter" href="#">Keuangan</a>
                                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ubahRoleModalCenter" href="#">Admin</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        3
                                    </th>
                                    <td class="text-start">riniapsari</td>
                                    <td class="text-start">riniapsari@bps.go.id</td>
                                    <td class="text-start">
                                        <span class="badge badge-warning">User</span>
                                    </td>
                                    <td>
                                        <div class="btn-group dropdown">
                                            <button
                                                class="btn btn-warning dropdown-toggle"
                                                type="button"
                                                data-bs-toggle="dropdown">
                                                User
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li>
                                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ubahRoleModalCenter" href="#">User</a>
                                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ubahRoleModalCenter" href="#">Keuangan</a>
                                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ubahRoleModalCenter" href="#">Admin</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        4
                                    </th>
                                    <td class="text-start">agus.sumarna</td>
                                    <td class="text-start">agus.sumarna@bps.go.id</td>
                                    <td class="text-start">
                                        <span class="badge badge-primary">Keuangan</span>
                                    </td>
                                    <td>
                                        <div class="btn-group dropdown">
                                            <button
                                                class="btn btn-primary dropdown-toggle"
                                                type="button"
                                                data-bs-toggle="dropdown">
                                                Keuangan
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li>
                                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ubahRoleModalCenter" href="#">User</a>
                                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ubahRoleModalCenter" href="#">Keuangan</a>
                                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ubahRoleModalCenter" href="#">Admin</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        5
                                    </th>
                                    <td class="text-start">alifah</td>
                                    <td class="text-start">alifah@bps.go.id</td>
                                    <td class="text-start">
                                        <span class="badge badge-danger">Admin</span>
                                    </td>
                                    <td>
                                        <div class="btn-group dropdown">
                                            <button
                                                class="btn btn-danger dropdown-toggle"
                                                type="button"
                                                data-bs-toggle="dropdown">
                                                Admin
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li>
                                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ubahRoleModalCenter" href="#">User</a>
                                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ubahRoleModalCenter" href="#">Keuangan</a>
                                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#ubahRoleModalCenter" href="#">Admin</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection