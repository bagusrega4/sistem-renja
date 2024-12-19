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
                                @foreach ($pengajuan as $p)
                                <tr>
                                    <th scope="row">
                                        {{ $loop->iteration }}
                                    </th>
                                    <td class="text-end">{{ $p->no_fp }}</td>
                                    <td class="text-end">{{ $p->tanggal_mulai }}</td>
                                    <td class="text-end">{{ $p->uraian }}</td>
                                    <td class="text-end">{{ $pegawai->nama }}</td>
                                    <td class="text-end">
                                        <div class="d-flex justify-content-end">
                                            <button type="button" class="btn btn-primary btn-sm me-2" data-bs-toggle="modal" data-bs-target="#viewModalCenter{{ $p->no_fp }}" data-bs-no-fp="{{ $p -> no_fp}}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-info btn-sm me-2" onclick="window.location.href = ' {{ route('monitoring.keuangan.file', $p->no_fp) }}'">
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

<!-- Modal View -->
@foreach($pengajuan as $fp)
<div class="modal fade" id="viewModalCenter{{ $fp->no_fp }}" tabindex="-1" role="dialog" aria-labelledby="viewModalCenterTitle" aria-labelledby="viewModalCenterTitle{{ $fp->no_fp }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalCenterTitle">View Pengajuan</h5>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>RO</th>
                                <th>Komponen</th>
                                <th>Sub Komponen</th>
                                <th>Akun</th>
                                <th>No. FP</th>
                                <th>Tanggal Kegiatan</th>
                                <th>Nama Permintaan</th>
                                <th>No. SK</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-end">{{$fp -> output -> kode_kegiatan}}.{{$fp -> output -> kode_kro}}.{{$fp -> output -> kode_ro}} - {{$fp -> output -> output}}</td>
                                <td class="text-end">{{$fp -> komponen -> komponen}}</td>
                                <td class="text-end">{{$fp -> subKomponen -> sub_komponen}}</td>
                                <td class="text-end">{{$fp -> akunBelanja -> akun_belanja}}</td>
                                <td class="text-end">{{$fp -> no_fp}}</td>
                                <td class="text-end">{{$fp -> tanggal_mulai}} - {{$fp -> tanggal_akhir}}</td>
                                <td class="text-end">{{$fp -> uraian}}</td>
                                <td class="text-end">{{$fp -> no_sk}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
