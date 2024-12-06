@extends('layout')
@section('content')
<div class="container">
    <div class="page-inner">
        <div
            class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h2 class="fw-bold mb-3">Manage Flag</h2>
                <h6 class="op-7 mb-2">Mengatur Flag Tabel Komponen</h6>
            </div>
            <div class="ms-md-auto py-2 py-md-0">
                <a href="form_add_komponen_flag.html" class="btn btn-primary btn-round">Tambah Komponen</a>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card card-round">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                        <div class="card-title">Tabel Komponen</div>
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
                                    <th>Nama Komponen</th>
                                    <th>Flag</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">
                                        1
                                    </th>
                                    <td class="text-start">1</td>
                                    <td class="text-start">Gaji dan Tunjangan</td>
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
                                    <td class="text-start">2</td>
                                    <td class="text-start">Operasional dan Pemeliharaan Kantor</td>
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
                                        3
                                    </th>
                                    <td class="text-start">5</td>
                                    <td class="text-start">Dukungan Penyelenggaraan Tugas dan Fungsi Unit</td>
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
                                        4
                                    </th>
                                    <td class="text-start">51</td>
                                    <td class="text-start">Persiapan</td>
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
                                        5
                                    </th>
                                    <td class="text-start">52</td>
                                    <td class="text-start">Pengumpulan Data</td>
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
                                        6
                                    </th>
                                    <td class="text-start">53</td>
                                    <td class="text-start">Pengolahan dan Analisis</td>
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
                                        7
                                    </th>
                                    <td class="text-start">54</td>
                                    <td class="text-start">Diseminasi dan Evaluasi</td>
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