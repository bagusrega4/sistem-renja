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
                <h2 class="fw-bold mb-3">Tambah Output</h2>
                <h6 class="op-7 mb-2">Menambahkan Output Baru</h6>
            </div>
            <div class="ms-md-auto py-2 py-md-0">
                <a href="{{ route('manage.mak.output') }}" class="btn btn-danger btn-round">Kembali</a>
            </div>
        </div>

        <div class="card card-round">
            <div class="card-body">
                <form action="{{ route('manage.mak.output.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="id_kegiatan" class="form-label">Kegiatan</label>
                        <select name="id_kegiatan" class="form-select" id="id_kegiatan" required>
                            <option value="">Pilih Kode Kegiatan</option>
                            @foreach($kegiatans as $kegiatan)
                                <option value="{{ $kegiatan->id }}" {{ old('id_kegiatan') == $kegiatan->id ? 'selected' : '' }}>
                                    [{{ $kegiatan->kode }}]     {{ $kegiatan->kegiatan }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="id_kro" class="form-label">KRO</label>
                        <select name="id_kro" class="form-select" id="id_kro" required>
                            <option value="">Pilih KRO</option>
                            @foreach($kros as $kro)
                                <option value="{{ $kro->id }}" {{ old('id_kro') == $kro->id ? 'selected' : '' }}>
                                    [{{ $kro->kode }}]      {{ $kro->kro }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="kode_ro" class="form-label">Kode RO</label>
                        <input type="text" name="kode_ro" class="form-control" id="kode_ro" value="{{ old('kode_ro') }}" maxlength="3" required>
                    </div>
                    <div class="mb-3">
                        <label for="output" class="form-label">Output</label>
                        <textarea name="output" id="output" class="form-control" rows="3" required>{{ old('output') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="flag" class="form-label">Flag</label>
                        <select name="flag" id="flag" class="form-select" required>
                            <option value="1" {{ old('flag', 1) == 1 ? 'selected' : '' }}>Tampilkan</option>
                            <option value="0" {{ old('flag', 1) == 0 ? 'selected' : '' }}>Jangan Tampilkan</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
