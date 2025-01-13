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

                    <!-- Kegiatan -->
                    <div class="mb-3">
                        <label for="id_kegiatan" class="form-label">Kegiatan</label>
                        <select
                            name="id_kegiatan"
                            class="form-select @error('id_kegiatan') is-invalid @enderror"
                            id="id_kegiatan"
                            required
                        >
                            <option value="">-- Pilih Kode Kegiatan --</option>
                            @foreach($kegiatans as $kegiatan)
                                <option value="{{ $kegiatan->id }}" {{ old('id_kegiatan') == $kegiatan->id ? 'selected' : '' }}>
                                    [{{ $kegiatan->kode }}]     {{ $kegiatan->kegiatan }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_kegiatan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- KRO -->
                    <div class="mb-3">
                        <label for="id_kro" class="form-label">KRO</label>
                        <select
                            name="id_kro"
                            class="form-select @error('id_kro') is-invalid @enderror"
                            id="id_kro"
                            required
                        >
                            <option value="">-- Pilih KRO --</option>
                            @foreach($kros as $kro)
                                <option value="{{ $kro->id }}" {{ old('id_kro') == $kro->id ? 'selected' : '' }}>
                                    [{{ $kro->kode }}]      {{ $kro->kro }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_kro')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Kode RO -->
                    <div class="mb-3">
                        <label for="kode_ro" class="form-label">Kode RO</label>
                        <input
                            type="text"
                            name="kode_ro"
                            class="form-control @error('kode_ro') is-invalid @enderror"
                            id="kode_ro"
                            value="{{ old('kode_ro') }}"
                            maxlength="3"
                            placeholder="Masukkan Kode RO"
                            required
                        >
                        @error('kode_ro')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Output -->
                    <div class="mb-3">
                        <label for="output" class="form-label">Output</label>
                        <textarea
                            name="output"
                            id="output"
                            class="form-control @error('output') is-invalid @enderror"
                            rows="3"
                            placeholder="Masukkan deskripsi output"
                            required
                        >{{ old('output') }}</textarea>
                        @error('output')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Tampilkan -->
                    <div class="mb-3">
                        <label for="flag" class="form-label">Flag</label>
                        <select
                            name="flag"
                            id="flag"
                            class="form-select @error('flag') is-invalid @enderror"
                            required
                        >
                            <option value="1" {{ old('flag', 1) == 1 ? 'selected' : '' }}>Tampilkan</option>
                            <option value="0" {{ old('flag', 1) == 0 ? 'selected' : '' }}>Jangan Tampilkan</option>
                        </select>
                        @error('flag')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
