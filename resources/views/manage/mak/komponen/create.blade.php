@extends('layouts/app')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h2 class="fw-bold mb-3">Tambah Komponen</h2>
                <h6 class="op-7 mb-2">Menambahkan Komponen Baru</h6>
            </div>
            <div class="ms-md-auto py-2 py-md-0">
                <a href="{{ route('manage.mak.komponen') }}" class="btn btn-danger btn-round">Kembali</a>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card card-round">
            <div class="card-body">
                <form action="{{ route('manage.mak.komponen.store') }}" method="POST">
                    @csrf

                    <!-- Kode Komponen -->
                    <div class="mb-3">
                        <label for="kode" class="form-label">Kode Komponen</label>
                        <input
                            type="text"
                            name="kode"
                            class="form-control @error('kode') is-invalid @enderror"
                            id="kode"
                            value="{{ old('kode') }}"
                            placeholder="Masukkan kode komponen"
                            required
                        >
                        @error('kode')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Nama Komponen -->
                    <div class="mb-3">
                        <label for="komponen" class="form-label">Nama Komponen</label>
                        <input
                            type="text"
                            name="komponen"
                            class="form-control @error('komponen') is-invalid @enderror"
                            id="nama_komponen"
                            value="{{ old('komponen') }}"
                            placeholder="Masukkan nama komponen"
                            required
                        >
                        @error('komponen')
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
