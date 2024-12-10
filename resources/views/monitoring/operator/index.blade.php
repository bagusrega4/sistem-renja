@extends('layout')
@section('content')
<div class="container">
    <div class="page-inner">
      <div
        class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
      >
        <div>
          <h2 class="fw-bold mb-3">Monitoring</h2>
          <h6 class="op-7 mb-2">Monitoring Rincian Kegiatan</h6>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
          <a href="form_admin.html" class="btn btn-primary btn-round">Tambah Pengajuan</a>
        </div>
      </div>
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
                      aria-expanded="false"
                    >
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
                      <td class="text-end">
                        <div class="d-flex justify-content-end">
                          <button type="button" class="btn btn-primary btn-sm me-2" data-bs-toggle="modal" data-bs-target="#viewModalCenter">
                            <i class="fas fa-eye"></i>
                          </button>
                          <button class="btn btn-secondary btn-sm me-2" onclick="window.location.href='form_admin.html'">
                            <i class="fas fa-edit"></i>
                          </button>
                          <button class="btn btn-info btn-sm me-2" onclick="window.location.href='upload_file_admin.html'">
                            <i class="fas fa-desktop"></i>
                          </button>
                          <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModalCenter">
                            <i class="fas fa-trash-alt"></i>
                          </button>
                        </div>
                      </td>
                      <td class="text-end">
                        <span class="badge badge-warning">Pengecekan Dokumen</span>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">
                        2
                      </th>
                      <td class="text-end">175</td>
                      <td class="text-end">18/05/2024 - 26/05/2024</td>
                      <td class="text-end">Supervisi Sensus Penduduk</td>
                      <td class="text-end">
                        <div class="d-flex justify-content-end">
                          <button type="button" class="btn btn-primary btn-sm me-2" data-bs-toggle="modal" data-bs-target="#viewModalCenter">
                            <i class="fas fa-eye"></i>
                          </button>
                          <button class="btn btn-secondary btn-sm me-2" onclick="window.location.href='form_admin.html'">
                            <i class="fas fa-edit"></i>
                          </button>
                          <button class="btn btn-info btn-sm me-2" onclick="window.location.href='upload_file_OP.html'">
                            <i class="fas fa-desktop"></i>
                          </button>
                          <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModalCenter">
                            <i class="fas fa-trash-alt"></i>
                          </button>
                        </div>
                      </td>
                      <td class="text-end">
                        <span class="badge badge-danger">Entri Operator</span>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">
                        3
                      </th>
                      <td class="text-end">165</td>
                      <td class="text-end">04/06/2024 - 10/06/2024</td>
                      <td class="text-end">Supervisi Sensus Tani</td>
                      <td class="text-end">
                        <div class="d-flex justify-content-end">
                          <button type="button" class="btn btn-primary btn-sm me-2" data-bs-toggle="modal" data-bs-target="#viewModalCenter">
                            <i class="fas fa-eye"></i>
                          </button>
                          <button class="btn btn-secondary btn-sm me-2" onclick="window.location.href='form_admin.html'">
                            <i class="fas fa-edit"></i>
                          </button>
                          <button class="btn btn-info btn-sm me-2" onclick="window.location.href='upload_file_OP.html'">
                            <i class="fas fa-desktop"></i>
                          </button>
                          <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModalCenter">
                            <i class="fas fa-trash-alt"></i>
                          </button>
                        </div>
                      </td>
                      <td class="text-end">
                        <span class="badge badge-primary">Proses Pembayaran</span>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">
                        4
                      </th>
                      <td class="text-end">195</td>
                      <td class="text-end">16/07/2024 - 27/07/2024</td>
                      <td class="text-end">Supervisi Survei Angakatan Kerja Nasional</td>
                      <td class="text-end">
                        <div class="d-flex justify-content-end">
                          <button type="button" class="btn btn-primary btn-sm me-2" data-bs-toggle="modal" data-bs-target="#viewModalCenter">
                            <i class="fas fa-eye"></i>
                          </button>
                          <button class="btn btn-secondary btn-sm me-2" onclick="window.location.href='form_admin.html'">
                            <i class="fas fa-edit"></i>
                          </button>
                          <button class="btn btn-info btn-sm me-2" onclick="window.location.href='upload_file_OP.html'">
                            <i class="fas fa-desktop"></i>
                          </button>
                          <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModalCenter">
                            <i class="fas fa-trash-alt"></i>
                          </button>
                        </div>
                      </td>
                      <td class="text-end">
                        <span class="badge badge-success">Selesai</span>
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
