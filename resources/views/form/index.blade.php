@extends('layout')
@section('content')
<div class="container">
    <div class="page-inner">
        <div
            class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h2 class="fw-bold mb-3">Form</h2>
                <h6 class="op-7 mb-2">
                    Form Registrasi Bukti Dukung Administrasi
                    BPS Provinsi DKI Jakarta Tahun Anggaran 2024
                </h6>
            </div>
            <div class="ms-md-auto py-2 py-md-0">
                <a
                    href="monitoring_admin.html"
                    class="btn btn-primary btn-round">Monitoring Rincian Kegiatan</a>
            </div>
        </div>

        <!-- Form Section -->
        <form>
            <div class="mb-3">
                <label for="ro" class="form-label">Rincian Output
                    <span class="text-danger">*</span></label>
                <select class="form-select" id="ro">
                    <option value="" disabled selected hidden>
                        Choose
                    </option>
                    <option value="1">
                        2896.BMA.004 - PUBLIKASI/LAPORAN
                        ANALISIS DAN PENGEMBANGAN STATISTIK
                    </option>
                    <option value="1">
                        2896.QMA.006 - PEMANFAATAN BIG DATA
                        UNTUK STATISTIK RESMI
                    </option>
                    <option value="3">....</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="komponen" class="form-label">Komponen
                    <span class="text-danger">*</span></label>
                <select class="form-select" id="komponen">
                    <option value="" disabled selected hidden>
                        Choose
                    </option>
                    <option value="1">
                        001 - Gaji dan Tunjangan
                    </option>
                    <option value="2">
                        002 - Operasional dan Pemeliharaan
                        Kantor
                    </option>
                    <option value="3">....</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="sub_komponen" class="form-label">Sub Komponen
                    <span class="text-danger">*</span></label>
                <select class="form-select" id="sub_komponen">
                    <option value="" disabled selected hidden>
                        Choose
                    </option>
                    <option value="1">EWS</option>
                    <option value="2">
                        Tanpa Sub Komponen
                    </option>
                </select>
            </div>

            <div class="mb-3">
                <label for="akun" class="form-label">Akun
                    <span class="text-danger">*</span></label>
                <select class="form-select" id="akun">
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

            <!-- Nomor FP -->
            <div class="mb-3">
                <label for="nomorFP" class="form-label">Nomor Form Pengajuan (FP)
                    <span class="text-danger">*</span></label>
                <small class="form-text text-muted">
                    Beberapa angka setelah - (strip) terakhir.
                    Nomor FP terdapat di pojok kanan atas Form
                    Permintaan (Bukan di bagian tengah)
                </small>
                <input
                    type="text"
                    class="form-control"
                    id="nomorFP"
                    placeholder="Your answer"
                    required />
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label for="tanggalMulai" class="form-label">Tanggal Mulai Kegiatan
                        <span class="text-danger">*</span></label>
                    <input
                        type="date"
                        class="form-control"
                        id="tanggalMulai"
                        placeholder="dd/mm/yyyy" />
                </div>
                <div class="col">
                    <label for="tanggalAkhir" class="form-label">Tanggal Akhir Kegiatan
                        <span class="text-danger">*</span></label>
                    <input
                        type="date"
                        class="form-control"
                        id="tanggalAkhir"
                        placeholder="dd/mm/yyyy" />
                </div>
            </div>

            <!-- Nomor SK -->
            <div class="mb-3">
                <label for="nomorSK" class="form-label">Nomor SK/Surat Tugas
                    <span class="text-danger">*</span></label>
                <small class="form-text text-muted">
                    Contoh: 001/31510/VS.100/2024
                </small>
                <input
                    type="text"
                    class="form-control"
                    id="nomorSK"
                    placeholder="Your answer"
                    required />
            </div>

            <!-- Uraian -->
            <div class="mb-3">
                <label for="uraian" class="form-label">Uraian
                    <span class="text-danger">*</span></label>
                <small class="form-text text-muted">
                    Contoh: Supervisi Susenas Maret 2024
                </small>
                <input
                    type="text"
                    class="form-control"
                    id="uraian"
                    placeholder="Your answer"
                    required />
            </div>

            <!-- Nominal -->
            <div class="mb-3">
                <label for="nominal" class="form-label">Nominal
                    <span class="text-danger">*</span></label>
                <input
                    type="number"
                    class="form-control"
                    id="nominal"
                    placeholder="Your answer"
                    required />
            </div>

            <!-- PJ Berkas -->
            <div class="mb-3">
                <label for="pjBerkas" class="form-label">PJ Berkas
                    <span class="text-danger">*</span></label>
                <small class="form-text text-muted">
                    Nama pengunggah berkas atau yang diberikan
                    tanggung jawab atas pengajuan berkas.
                </small>
                <input
                    type="text"
                    class="form-control"
                    id="pjBerkas"
                    placeholder="Your answer"
                    required />
            </div>
        </form>

        <div
            class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div class="ms-md-auto py-2 py-md-0">
                <a href="#" class="btn btn-success btn-round">Kirim</a>
            </div>
        </div>
    </div>
</div>
@endsection