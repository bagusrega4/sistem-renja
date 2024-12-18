@extends('layouts/app')

@section('content')
<div class="container">
    <div class="page-inner">
        <!-- Notifikasi Error -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
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
                <form action="{{ route('monitoring.operator.storeFile') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="no_fp" class="form-label">No FP</label>
                        <input type="number" name="no_fp" class="form-control" id="no_fp" value="{{$form -> no_fp}}" required readonly>
                    </div>

                    <div class="mb-3">
                        <label for="nama_permintaan" class="form-label">Nama Permintaan</label>
                        <input type="text" name="nama_permintaan" class="form-control" id="nama_permintaan" value="{{$form -> uraian}}" required readonly>
                    </div>

                    <div class="mb-3">
                        <label for="kak_ttd" class="form-label">KAK TTD</label>
                        <input type="file" name="kak_ttd" class="form-control" id="kak_ttd" accept="image/*" required>
                    </div>

                    <div class="mb-3">
                        <label for="surat_tugas" class="form-label">Surat Tugas</label>
                        <input type="file" name="surat_tugas" class="form-control" id="surat_tugas" accept="image/*" required>
                    </div>

                    <div class="mb-3">
                        <label for="sk_kpa" class="form-label">SK KPA</label>
                        <input type="file" name="sk_kpa" class="form-control" id="sk_kpa" accept="image/*" required>
                    </div>

                    <div class="mb-3">
                        <label for="laporan_innas" class="form-label">Laporan Innas</label>
                        <input type="file" name="laporan_innas" class="form-control" id="laporan_innas" accept="image/*" required>
                    </div>

                    <div class="mb-3">
                        <label for="daftar_hadir" class="form-label">Daftar Hadir</label>
                        <input type="file" name="daftar_hadir" class="form-control" id="daftar_hadir" accept="image/*" required>
                    </div>

                    <div class="mb-3">
                        <label for="absen_harian" class="form-label">Absen Harian</label>
                        <input type="file" name="absen_harian" class="form-control" id="absen_harian" accept="image/*" required>
                    </div>

                    <div class="mb-3">
                        <label for="rekap_norek_innas" class="form-label">Rekap Norek Innas</label>
                        <input type="file" name="rekap_norek_innas" class="form-control" id="rekap_norek_innas" accept="image/*" required>
                    </div>

                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
