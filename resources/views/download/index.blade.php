@extends('layout')
@section('content')
<div class="container">
    <div class="page-inner">
        <div
            class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h2 class="fw-bold mb-3">Download</h2>
                <h6 class="op-7 mb-2">
                    Download Pengajuan Bukti Dukung Administrasi
                    (BDA)
                </h6>
            </div>
        </div>

        <h5 class="fw-bold mb-3">Pilih Filter Download</h5>

        <div class="d-flex justify-content-between">
            <div
                class="mb-3"
                style="flex: 1; margin-right: 20px">
                <label for="tanggalMulai" class="form-label">Tanggal Mulai Kegiatan</label>
                <input
                    type="date"
                    class="form-control"
                    id="tanggalMulai"
                    placeholder="dd/mm/yyyy"
                    style="max-width: 100%" />
            </div>

            <div class="mb-3" style="flex: 1">
                <label for="tanggalAkhir" class="form-label">Tanggal Akhir Kegiatan</label>
                <input
                    type="date"
                    class="form-control"
                    id="tanggalAkhir"
                    placeholder="dd/mm/yyyy"
                    style="max-width: 100%" />
            </div>
        </div>

        <div class="mb-3">
            <label for="akun" class="form-label">Akun </label>
            <select
                class="form-select"
                id="akun"
                style="max-width: 618px">
                <option value="" disabled selected hidden>
                    Choose
                </option>
                <option value="1">
                    522151 - Belanja Jasa Profesi
                </option>
                <option value="2">
                    524111 - Belanja Perjalanan Dinas Biasa
                </option>
                <option value="3">....</option>
            </select>
        </div>

        <div>
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div
                            class="card-head-row card-tools-still-right">
                            <div class="card-title">
                                Tabel Monitoring
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table
                                id="example"
                                class="table table-striped"
                                style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>No. FP</th>
                                        <th>
                                            Tanggal Kegiatan
                                        </th>
                                        <th>Nama Permintaan</th>
                                        <th>Aksi</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td class="text-end">
                                            144
                                        </td>
                                        <td class="text-end">
                                            15/04/2024 -
                                            20/04/2024
                                        </td>
                                        <td class="text-end">
                                            Supervisi Sensus
                                            Ekonomi
                                        </td>
                                        <td class="text-end">
                                            <div
                                                class="d-flex justify-content-end">
                                                <input
                                                    type="checkbox"
                                                    class="form-check-input"
                                                    style="
                                                                        transform: scale(
                                                                            1.5
                                                                        );
                                                                    " />
                                            </div>
                                        </td>
                                        <td class="text-end">
                                            <span
                                                class="badge badge-warning">Pengecekan
                                                Dokumen</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td class="text-end">
                                            175
                                        </td>
                                        <td class="text-end">
                                            18/05/2024 -
                                            26/05/2024
                                        </td>
                                        <td class="text-end">
                                            Supervisi Sensus
                                            Penduduk
                                        </td>
                                        <td class="text-end">
                                            <div
                                                class="d-flex justify-content-end">
                                                <input
                                                    type="checkbox"
                                                    class="form-check-input"
                                                    style="
                                                                        transform: scale(
                                                                            1.5
                                                                        );
                                                                    " />
                                            </div>
                                        </td>
                                        <td class="text-end">
                                            <span
                                                class="badge badge-secondary">Entri
                                                Operator</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td class="text-end">
                                            165
                                        </td>
                                        <td class="text-end">
                                            04/06/2024 -
                                            10/06/2024
                                        </td>
                                        <td class="text-end">
                                            Supervisi Sensus
                                            Tani
                                        </td>
                                        <td class="text-end">
                                            <div
                                                class="d-flex justify-content-end">
                                                <input
                                                    type="checkbox"
                                                    class="form-check-input"
                                                    style="
                                                                        transform: scale(
                                                                            1.5
                                                                        );
                                                                    " />
                                            </div>
                                        </td>
                                        <td class="text-end">
                                            <span
                                                class="badge badge-primary">Proses
                                                Pembayaran</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">4</th>
                                        <td class="text-end">
                                            195
                                        </td>
                                        <td class="text-end">
                                            16/07/2024 -
                                            27/07/2024
                                        </td>
                                        <td class="text-end">
                                            Supervisi Survei
                                            Angakatan Kerja
                                            Nasional
                                        </td>
                                        <td class="text-end">
                                            <div
                                                class="d-flex justify-content-end">
                                                <input
                                                    type="checkbox"
                                                    class="form-check-input"
                                                    style="
                                                                        transform: scale(
                                                                            1.5
                                                                        );
                                                                    " />
                                            </div>
                                        </td>
                                        <td class="text-end">
                                            <span
                                                class="badge badge-success">Selesai</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div
            class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div class="ms-md-auto py-2 py-md-0">
                <a href="#" class="btn btn-primary btn-round">Download Pengajuan</a>
            </div>
        </div>
    </div>
</div>
@endsection