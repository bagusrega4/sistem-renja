@extends('layouts/app')

@section('content')
<div class="container">
    <div class="page-inner">
        <!-- Notifikasi Error Custom -->
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <!-- Notifikasi Validasi Error -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- Notifikasi Sukses -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h2 class="fw-bold mb-3">Upload File Operator</h2>
                <h6 class="op-7 mb-2">Mengunggah Berkas-Berkas Bukti Pendukung Form Pengajuan</h6>
            </div>
            <div class="ms-md-auto py-2 py-md-0">
                <a href="{{ route('monitoring.operator.index') }}" class="btn btn-danger btn-round">Kembali</a>
            </div>
        </div>

        <div class="card card-round">
            <div class="card-body">
                <form action="{{ route('monitoring.operator.store', $formPengajuan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @switch($formPengajuan->id_status)
                        @case(1)
                            @break
                        @case(2)
                            <div class="alert alert-warning d-flex align-items-center mt-2" role="alert">
                                <i class="fas fa-hourglass-half fa-2x me-2"></i>
                                <div>
                                    <strong>Dokumen Anda sedang dalam proses pemeriksaan oleh Tim Keuangan.</strong>
                                    Proses pemeriksaan dilakukan secara mendetail, mohon bersabar.
                                </div>
                            </div>
                            @break
                        @case(3)
                            <div class="alert alert-danger d-flex align-items-center mt-2" role="alert">
                                <i class="fas fa-ban fa-2x me-2"></i>
                                <div>
                                    <strong>Pengajuan telah Ditolak.</strong>
                                    Harap lakukan perbaikan dokumen.
                                </div>
                            </div>
                            @break
                        @case(4)
                            <div class="alert alert-success d-flex align-items-center mt-2" role="alert">
                                <i class="fas fa-check-circle fa-2x me-2"></i>
                                <div>
                                    <strong>Pengajuan telah Disetujui.</strong>
                                    Mohon tunggu Tim Keuangan mengisi form keuangan.
                                </div>
                            </div>
                            @break
                        @case(5)
                            <div class="alert alert-info d-flex align-items-center mt-2" role="alert">
                                <i class="fas fa-check-double fa-2x me-2"></i>
                                <div>
                                    <strong>Pengajuan telah Selesai.</strong>
                                    Semua proses dan verifikasi sudah tuntas.
                                </div>
                            </div>
                            @break
                        @default
                            <div class="alert alert-secondary d-flex align-items-center mt-2" role="alert">
                                <i class="fas fa-exclamation-circle fa-2x me-2"></i>
                                <div>
                                    <strong>Dokumen gagal diperiksa</strong>,
                                    karena status pengajuan saat ini tidak memenuhi kriteria perubahan.
                                </div>
                            </div>
                    @endswitch

                    <!-- No FP (readonly) -->
                    <div class="mb-3">
                        <label for="no_fp" class="form-label">No FP</label>
                        <input type="number" name="no_fp" class="form-control" id="no_fp" value="{{ $formPengajuan->no_fp }}" required readonly>
                    </div>

                    <!-- Nama Permintaan (readonly) -->
                    <div class="mb-3">
                        <label for="nama_permintaan" class="form-label">Nama Permintaan</label>
                        <input type="text" name="nama_permintaan" class="form-control" id="nama_permintaan" value="{{ $formPengajuan->uraian }}" required readonly>
                    </div>

                    <!-- Akun Belanja (readonly) -->
                    <div class="mb-3">
                        <label for="akun_belanja" class="form-label">Akun Belanja</label>
                        <input type="text" name="akun_belanja" class="form-control" id="akun_belanja" value="{{ $formPengajuan->akunBelanja->nama_akun }}" required readonly>
                    </div>

                    <!-- Input File Dinamis -->
                    @foreach ($jenisFilesOperator as $jenisFileOperator)
                        @php
                            $fileKey = str_replace(' ', '_', $jenisFileOperator->nama_file);
                        @endphp
                        <div class="mb-3">
                            <label for="{{ $fileKey }}" class="form-label">
                                {{ ucfirst(str_replace('_', ' ', $jenisFileOperator->nama_file)) }}
                            </label>
                            @switch($formPengajuan->id_status)
                                @case(1)
                                @case(3)
                                    <div class="input-group">
                                        <input
                                            type="file"
                                            name="{{ $fileKey }}"
                                            class="form-control @error($fileKey) is-invalid @enderror"
                                            id="{{ $fileKey }}"
                                            accept=".jpeg,.jpg,.png,.pdf,.doc,.docx,.xls,.xlsx"
                                            required
                                            onchange="toggleResetButton('{{ $fileKey }}','btn_reset_{{ $fileKey }}')"
                                        >
                                        <button
                                            type="button"
                                            class="btn btn-outline-danger"
                                            id="btn_reset_{{ $fileKey }}"
                                            style="display: none;"
                                            onclick="resetFileInput('{{ $fileKey }}','btn_reset_{{ $fileKey }}')"
                                        >X</button>
                                    </div>
                                    @break
                                @default
                                    <div class="input-group">
                                        <input
                                            type="file"
                                            name="{{ $fileKey }}"
                                            class="form-control @error($fileKey) is-invalid @enderror"
                                            id="{{ $fileKey }}"
                                            accept=".jpeg,.jpg,.png,.pdf,.doc,.docx,.xls,.xlsx"
                                            disabled
                                        >
                                        <button
                                            type="button"
                                            class="btn btn-outline-danger"
                                            id="btn_reset_{{ $fileKey }}"
                                            style="display: none;"
                                            onclick="resetFileInput('{{ $fileKey }}','btn_reset_{{ $fileKey }}')"
                                            disabled
                                        >X</button>
                                    </div>
                                    <small class="text-muted">Pengajuan tidak dapat diubah pada status ini.</small>
                            @endswitch
                            @error($fileKey)
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    @endforeach
                    @switch($formPengajuan->id_status)
                        @case(1)
                        @case(3)
                            <button type="submit" class="btn btn-success">Simpan</button>
                            @break
                        @default
                    @endswitch
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Script untuk reset dan toggle tombol reset -->
<script>
    function resetFileInput(fileInputId, buttonId) {
        var fileInput = document.getElementById(fileInputId);
        fileInput.value = "";
        document.getElementById(buttonId).style.display = "none";
    }

    function toggleResetButton(fileInputId, buttonId) {
        var fileInput = document.getElementById(fileInputId);
        var button = document.getElementById(buttonId);

        if (fileInput.value) {
            button.style.display = "inline-block";
        } else {
            button.style.display = "none";
        }
    }
</script>
@endsection
