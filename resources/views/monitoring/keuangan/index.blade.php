@extends('layouts/app')
@section('content')
<div class="container">
    <div class="page-inner">
        <div
            class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h2 class="fw-bold mb-3">Monitoring Keuangan</h2>
                <h6 class="op-7 mb-2">Monitoring pengajuan yang diajukan oleh Operator</h6>
            </div>
            <!-- <div class="ms-md-auto py-2 py-md-0">
                <a href="monitoring_file_keuangan.html" class="btn btn-label-info btn-round me-2">Monitoring File</a>
                <a href="form_keuangan.html" class="btn btn-primary btn-round">Tambah Pengajuan</a>
              </div> -->
        </div>
        Tabel Monitoring
        <div class="col-md-12">
            <div class="card card-round">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                        <div class="card-title">Tabel Monitoring</div>
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
                                    <th>No. FP</th>
                                    <th>Tanggal Kegiatan</th>
                                    <th>Nama Permintaan</th>
                                    <th>Nama Pengaju</th>
                                    <th>Aksi</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">
                                        1
                                    </th>
                                    <td class="text-end">144</td>
                                    <td class="text-end">15/04/2024 - 20/04/2024</td>
                                    <td class="text-end">Supervisi Sensus Ekonomi</td>
                                    <td>Yulia Dhita</td>
                                    <td class="text-end">
                                        <div class="d-flex justify-content-end">
                                            <button class="btn btn-primary btn-sm me-2" data-bs-toggle="modal" data-bs-target="#viewModalCenter">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-info btn-sm me-2" onclick="window.location.href='monitoring_file_keuangan.html'">
                                                <i class="fas fa-desktop"></i>
                                            </button>
                                            <button class="btn btn-success btn-sm me-2" aria-label="upload file" onclick="window.location.href='form_tim_keuangan.html'">
                                                <i class="fas fa-upload"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <div class="dropdown">
                                            <button class="btn btn-success dropdown-toggle btn-sm" type="button" id="statusDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                                Approve
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="statusDropdown">
                                                <li><a class="dropdown-item" href="#">Approve Pengajuan</a></li>
                                                <li><a class="dropdown-item" href="#">Rejected Pengajuan</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        2
                                    </th>
                                    <td class="text-end">175</td>
                                    <td class="text-end">18/05/2024 - 26/05/2024</td>
                                    <td class="text-end">Supervisi Sensus Penduduk</td>
                                    <td>Blessi Muntia</td>
                                    <td class="text-end">
                                        <div class="d-flex justify-content-end">
                                            <button class="btn btn-primary btn-sm me-2" data-bs-toggle="modal" data-bs-target="#viewModalCenter">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-info btn-sm me-2" onclick="window.location.href='monitoring_file_keuangan.html'">
                                                <i class="fas fa-desktop"></i>
                                            </button>
                                            <button class="btn btn-success btn-sm me-2" aria-label="upload file" onclick="window.location.href='form_tim_keuangan.html'">
                                                <i class="fas fa-upload"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <div class="dropdown">
                                            <button class="btn btn-danger dropdown-toggle btn-sm" type="button" id="statusDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                                Rejected
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="statusDropdown">
                                                <li><a class="dropdown-item" href="#">Approve Pengajuan</a></li>
                                                <li><a class="dropdown-item" href="#">Rejected Pengajuan</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        3
                                    </th>
                                    <td class="text-end">165</td>
                                    <td class="text-end">04/06/2024 - 10/06/2024</td>
                                    <td class="text-end">Supervisi Sensus Tani</td>
                                    <td>Imalia Rosida</td>
                                    <td class="text-end">
                                        <div class="d-flex justify-content-end">
                                            <button class="btn btn-primary btn-sm me-2" data-bs-toggle="modal" data-bs-target="#viewModalCenter">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-info btn-sm me-2" onclick="window.location.href='monitoring_file_keuangan.html'">
                                                <i class="fas fa-desktop"></i>
                                            </button>
                                            <button class="btn btn-success btn-sm me-2" aria-label="upload file" onclick="window.location.href='form_tim_keuangan.html'">
                                                <i class="fas fa-upload"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <div class="dropdown">
                                            <button class="btn btn-success dropdown-toggle btn-sm" type="button" id="statusDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                                Approve
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="statusDropdown">
                                                <li><a class="dropdown-item" href="#">Approve Pengajuan</a></li>
                                                <li><a class="dropdown-item" href="#">Rejected Pengajuan</a></li>
                                            </ul>
                                        </div>
                                    </td>

                                </tr>
                                <tr>
                                    <th scope="row">
                                        4
                                    </th>
                                    <td class="text-end">180</td>
                                    <td class="text-end">14/06/2024 - 21/06/2024</td>
                                    <td class="text-end">Supervisi Survei Indeks Pembangunan Manusia</td>
                                    <td>Agape Bagus Rega</td>
                                    <td class="text-end">
                                        <div class="d-flex justify-content-end">
                                            <button class="btn btn-primary btn-sm me-2" data-bs-toggle="modal" data-bs-target="#viewModalCenter">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-info btn-sm me-2" onclick="window.location.href='monitoring_file_keuangan.html'">
                                                <i class="fas fa-desktop"></i>
                                            </button>
                                            <button class="btn btn-success btn-sm me-2" aria-label="upload file" onclick="window.location.href='form_tim_keuangan.html'">
                                                <i class="fas fa-upload"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <div class="dropdown">
                                            <button class="btn btn-danger dropdown-toggle btn-sm" type="button" id="statusDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                                Rejected
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="statusDropdown">
                                                <li><a class="dropdown-item" href="#">Approve Pengajuan</a></li>
                                                <li><a class="dropdown-item" href="#">Rejected Pengajuan</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        5
                                    </th>
                                    <td class="text-end">195</td>
                                    <td class="text-end">16/07/2024 - 27/07/2024</td>
                                    <td class="text-end">Supervisi Survei Angakatan Kerja Nasional</td>
                                    <td>Muhammad Ilham</td>
                                    <td class="text-end">
                                        <div class="d-flex justify-content-end">
                                            <button class="btn btn-primary btn-sm me-2" data-bs-toggle="modal" data-bs-target="#viewModalCenter">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-info btn-sm me-2" onclick="window.location.href='monitoring_file_keuangan.html'">
                                                <i class="fas fa-desktop"></i>
                                            </button>
                                            <button class="btn btn-success btn-sm me-2" aria-label="upload file" onclick="window.location.href='form_tim_keuangan.html'">
                                                <i class="fas fa-upload"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <div class="dropdown">
                                            <button class="btn btn-success dropdown-toggle btn-sm" type="button" id="statusDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                                Approve
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="statusDropdown">
                                                <li><a class="dropdown-item" href="#">Approve Pengajuan</a></li>
                                                <li><a class="dropdown-item" href="#">Rejected Pengajuan</a></li>
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