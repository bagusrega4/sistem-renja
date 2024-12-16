@extends('layouts/app')
@section('content')
<div class="container">
    <div class="page-inner">
        <div
            class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h2 class="fw-bold mb-3">Manage Flag</h2>
                <h6 class="op-7 mb-2">Mengatur Flag Tabel Sub Komponen</h6>
            </div>
            <div class="ms-md-auto py-2 py-md-0">
                <a href="form_add_subkomponen_flag.html" class="btn btn-primary btn-round">Tambah Sub Komponen</a>
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
                        <!-- Projects table -->
                        <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kode</th>
                                    <th>Sub manage_flag_komponen</th>
                                    <th>Flag</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">
                                        1
                                    </th>
                                    <td class="text-start">A</td>
                                    <td class="text-start">Tanpa Sub Komponen</td>
                                    <td class="text-start">1</td>
                                    <td>
                                        <div class="btn-group dropdown">
                                            <button
                                                class="btn btn-warning dropdown-toggle"
                                                type="button"
                                                data-bs-toggle="dropdown">
                                                1
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li>
                                                    <a class="dropdown-item" href="#">1</a>
                                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#changeFlagModalCenter" href="#">0</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        2
                                    </th>
                                    <td class="text-start">B</td>
                                    <td class="text-start">EWS (Economic White Survey)</td>
                                    <td class="text-start">1</td>
                                    <td>
                                        <div class="btn-group dropdown">
                                            <button
                                                class="btn btn-warning dropdown-toggle"
                                                type="button"
                                                data-bs-toggle="dropdown">
                                                1
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li>
                                                    <a class="dropdown-item" href="#">1</a>
                                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#changeFlagModalCenter" href="#">0</a>
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