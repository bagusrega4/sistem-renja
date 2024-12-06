@extends('layout')
@section('content')
<div class="container">
    <div class="page-inner">
        <div
            class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h2 class="fw-bold mb-3">Manage Flag</h2>
                <h6 class="op-7 mb-2">Mengatur Flag Tabel Output</h6>
            </div>
            <div class="ms-md-auto py-2 py-md-0">
                <a href="form_add_output_flag.html" class="btn btn-primary btn-round">Tambah Output</a>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card card-round">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                        <div class="card-title">Tabel Output</div>
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
                                    <th>Id</th>
                                    <th>Kode Kegiatan</th>
                                    <th>KRO</th>
                                    <th>RO</th>
                                    <th>Output</th>
                                    <th>Flag</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">
                                        1
                                    </th>
                                    <td class="text-start">24</td>
                                    <td class="text-start">2910</td>
                                    <td class="text-start">BMA</td>
                                    <td class="text-start">007</td>
                                    <td class="text-start">PUBLIKASI/ LAPORAN STATISTIK TANAMAN PANGAN</td>
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
                                        1
                                    </th>
                                    <td class="text-start">23</td>
                                    <td class="text-start">2909</td>
                                    <td class="text-start">BMA</td>
                                    <td class="text-start">005</td>
                                    <td class="text-start">PUBLIKASI/LAPORAN STATISTIK PETERNAKAN PERIKANAN DAN KEHUTANAN </td>
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
                                        1
                                    </th>
                                    <td class="text-start">21</td>
                                    <td class="text-start">2908</td>
                                    <td class="text-start">BMA</td>
                                    <td class="text-start">004</td>
                                    <td class="text-start">PUBLIKASI/LAPORAN STATISTIK KEUANGAN TEKNOLOGI INFORMASI DAN PARIWISATA</td>
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
                                        1
                                    </th>
                                    <td class="text-start">22</td>
                                    <td class="text-start">2908</td>
                                    <td class="text-start">BMA</td>
                                    <td class="text-start">009</td>
                                    <td class="text-start">PUBLIKASI/LAPORAN STATISTIK E-COMMERCE</td>
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
                                        1
                                    </th>
                                    <td class="text-start">19</td>
                                    <td class="text-start">2907</td>
                                    <td class="text-start">BMA</td>
                                    <td class="text-start">006</td>
                                    <td class="text-start">PUBLIKASI/LAPORAN STATISTIK KETAHANAN SOSIAL</td>
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
                                        1
                                    </th>
                                    <td class="text-start">20</td>
                                    <td class="text-start">2907</td>
                                    <td class="text-start">BMA</td>
                                    <td class="text-start">008</td>
                                    <td class="text-start">PUBLIKASI/LAPORAN PENDATAAN PODES</td>
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
                                        1
                                    </th>
                                    <td class="text-start">17</td>
                                    <td class="text-start">2906</td>
                                    <td class="text-start">BMA</td>
                                    <td class="text-start">003</td>
                                    <td class="text-start">PUBLIKASI/LAPORAN STATISTIK KESEJAHTERAAN RAKYAT</td>
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
                                        1
                                    </th>
                                    <td class="text-start">18</td>
                                    <td class="text-start">2906</td>
                                    <td class="text-start">BMA</td>
                                    <td class="text-start">006</td>
                                    <td class="text-start">PUBLIKASI/LAPORAN SUSENAS</td>
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
                                        1
                                    </th>
                                    <td class="text-start">15</td>
                                    <td class="text-start">2905</td>
                                    <td class="text-start">BMA</td>
                                    <td class="text-start">004</td>
                                    <td class="text-start">PUBLIKASI/LAPORAN SAKERNAS</td>
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
                                        1
                                    </th>
                                    <td class="text-start">16</td>
                                    <td class="text-start">2905</td>
                                    <td class="text-start">BMA</td>
                                    <td class="text-start">005</td>
                                    <td class="text-start">PUBLIKASI/LAPORAN STATISTIK KEPENDUDUKAN DAN KETENAGAKERJAAN</td>
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
                                        1
                                    </th>
                                    <td class="text-start">14</td>
                                    <td class="text-start">2904</td>
                                    <td class="text-start">BMA</td>
                                    <td class="text-start">006</td>
                                    <td class="text-start">PUBLIKASI/ LAPORAN STATISTIK TANAMAN PANGANPUBLIKASI/LAPORAN STATISTIK INDUSTRI PERTAMBANGAN DAN PENGGALIAN ENERGI DAN KONSTRUKSI</td>
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
                                        1
                                    </th>
                                    <td class="text-start">12</td>
                                    <td class="text-start">2903</td>
                                    <td class="text-start">BMA</td>
                                    <td class="text-start">009</td>
                                    <td class="text-start">PUBLIKASI/LAPORAN STATISTIK HARGA</td>
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