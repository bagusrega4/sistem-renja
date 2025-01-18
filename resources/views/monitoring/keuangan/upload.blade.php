@extends('layouts/app')

@section('content')
<div class="container">
    <div class="page-inner">
        <!-- Notifikasi Sukses -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h2 class="fw-bold mb-3">Form Tim Keuangan</h2>
                <h6 class="op-7 mb-2">Form Upload File Tim Keuangan BPS Provinsi DKI Jakarta Tahun Anggaran 2024</h6>
            </div>
            <div class="ms-md-auto py-2 py-md-0">
                <a href="{{ route('monitoring.keuangan.index') }}" class="btn btn-danger btn-round">Kembali</a>
            </div>
        </div>

        <div class="card card-round">
            <div class="card-body">
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif

                <form action="{{ route('monitoring.keuangan.store', $fp->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- No FP (readonly) -->
                    <div class="mb-3">
                        <label for="no_fp" class="form-label">No FP</label>
                        <input type="number" name="no_fp" class="form-control" id="no_fp" value="{{ $fp->no_fp }}" required readonly>
                    </div>

                    <!-- Nama Permintaan (readonly) -->
                    <div class="mb-3">
                        <label for="nama_permintaan" class="form-label">Nama Permintaan</label>
                        <input type="text" name="nama_permintaan" class="form-control" id="nama_permintaan" value="{{ $fp->uraian }}" required readonly>
                    </div>

                    <!-- Akun Belanja (readonly) -->
                    <div class="mb-3">
                        <label for="akun_belanja" class="form-label">Akun Belanja</label>
                        <input type="text" name="akun_belanja" class="form-control" id="akun_belanja" value="{{ $fp->akunBelanja->nama_akun }}" required readonly>
                    </div>

                    <!-- PJ Berkas (readonly) -->
                    <div class="mb-3">
                        <label for="pj_berkas" class="form-label">PJ Berkas</label>
                        <input type="text" name="pj_berkas" class="form-control" id="pj_berkas" value="{{ $fp->pegawai ? $fp->pegawai->nama : 'Data Pegawai Tidak Ditemukan' }}" required readonly>
                    </div>

                    <!-- Jenis Pembayaran -->
                    <div class="mb-3">
                        <label for="jenis_pembayaran" class="form-label">Jenis Pembayaran
                            <span class="text-danger">*</span></label>
                        <select
                            class="form-select @error('jenis_pembayaran') is-invalid @enderror"
                            id="jenis_pembayaran"
                            name="jenis_pembayaran"
                            required>
                            <option value="" disabled selected>Pilih Jenis Pembayaran</option>
                            <option value="GUP Tunai" {{ old('jenis_pembayaran') == 'GUP Tunai' ? 'selected' : '' }}>Ganti Uang Persediaan (GUP) Tunai</option>
                            <option value="GUP KKP" {{ old('jenis_pembayaran') == 'GUP KKP' ? 'selected' : '' }}>Ganti Uang Persediaan (GUP) KKP</option>
                            <option value="TUP" {{ old('jenis_pembayaran') == 'TUP' ? 'selected' : '' }}>Tambahan Uang Persediaan (TUP)</option>
                            <option value="LS" {{ old('jenis_pembayaran') == 'LS' ? 'selected' : '' }}>Transaksi Langsung (LS)</option>
                        </select>
                        @error('jenis_pembayaran')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Form Tim Keuangan -->
                    <!-- No. SPBy -->
                    <div class="mb-3 spby-field">
                        <label for="no_spby" class="form-label">No. SPBy
                            <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            class="form-control @error('no_spby') is-invalid @enderror"
                            id="no_spby"
                            name="no_spby"
                            placeholder="Masukkan No. SPBy"
                            value="{{ old('no_spby') }}"
                            required />
                        @error('no_spby')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- No. DRPP -->
                    <div class="mb-3 drpp-field">
                        <label for="no_drpp" class="form-label">No. DRPP
                            <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            class="form-control @error('no_drpp') is-invalid @enderror"
                            id="no_drpp"
                            name="no_drpp"
                            placeholder="Masukkan No. DRPP"
                            value="{{ old('no_drpp') }}"
                            required />
                        @error('no_drpp')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Tanggal DRPP -->
                    <div class="mb-3 drpp-date-field">
                        <label for="tanggal_drpp" class="form-label">Tanggal DRPP
                            <span class="text-danger">*</span></label>
                        <input
                            type="date"
                            class="form-control @error('tanggal_drpp') is-invalid @enderror"
                            id="tanggal_drpp"
                            name="tanggal_drpp"
                            value="{{ old('tanggal_drpp') }}"
                            required />
                        @error('tanggal_drpp')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="no_spm" class="form-label">No. SPM
                            <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            class="form-control @error('no_spm') is-invalid @enderror"
                            id="no_spm"
                            name="no_spm"
                            placeholder="Masukkan No. SPM"
                            value="{{ old('no_spm') }}"
                            required />
                        @error('no_spm')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_spm" class="form-label">Tanggal SPM
                            <span class="text-danger">*</span></label>
                        <input
                            type="date"
                            class="form-control @error('tanggal_spm') is-invalid @enderror"
                            id="tanggal_spm"
                            name="tanggal_spm"
                            value="{{ old('tanggal_spm') }}"
                            required />
                        @error('tanggal_spm')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Input File Dinamis -->
                    @foreach ($jenisFilesKeuangan as $jenisFileKeuangan)
                    @php
                    $fileKey = str_replace(' ', '_', $jenisFileKeuangan->nama_file);
                    @endphp
                    <div class="mb-3">
                        <label for="{{ $fileKey }}" class="form-label">
                            {{ ucfirst(str_replace('_', ' ', $jenisFileKeuangan->nama_file)) }}
                            <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <input
                                type="file"
                                name="{{ $fileKey }}"
                                class="form-control @error($fileKey) is-invalid @enderror"
                                id="{{ $fileKey }}"
                                accept=".jpeg,.jpg,.png,.pdf,.doc,.docx,.xls,.xlsx"
                                required
                                onchange="toggleResetButton('{{ $fileKey }}','btn_reset_{{ $fileKey }}')">
                            <button
                                type="button"
                                class="btn btn-outline-danger"
                                id="btn_reset_{{ $fileKey }}"
                                style="display: none;"
                                onclick="resetFileInput('{{ $fileKey }}','btn_reset_{{ $fileKey }}')">X</button>
                        </div>
                        @error($fileKey)
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    @endforeach

                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const jenisPembayaran = document.getElementById('jenis_pembayaran');
        const spbyField = document.querySelector('.spby-field');
        const drppField = document.querySelector('.drpp-field');
        const drppDateField = document.querySelector('.drpp-date-field');

        // Fungsi untuk mengatur visibilitas field berdasarkan pilihan
        function toggleFields() {
            if (jenisPembayaran.value === 'LS') {
                spbyField.style.display = 'none';
                drppField.style.display = 'none';
                drppDateField.style.display = 'none';

                // Set field menjadi tidak required jika disembunyikan
                spbyField.querySelector('input').removeAttribute('required');
                drppField.querySelector('input').removeAttribute('required');
                drppDateField.querySelector('input').removeAttribute('required');
            } else {
                spbyField.style.display = 'block';
                drppField.style.display = 'block';
                drppDateField.style.display = 'block';

                // Set field menjadi required jika ditampilkan
                spbyField.querySelector('input').setAttribute('required', 'required');
                drppField.querySelector('input').setAttribute('required', 'required');
                drppDateField.querySelector('input').setAttribute('required', 'required');
            }
        }

        // Event listener untuk dropdown
        jenisPembayaran.addEventListener('change', toggleFields);

        // Inisialisasi pada saat halaman dimuat
        toggleFields();
    });
</script>
@endpush