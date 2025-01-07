@extends('layouts/app')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h2 class="fw-bold mb-3">Tambah KRO</h2>
                <h6 class="op-7 mb-2">Menambahkan KRO Baru</h6>
            </div>
            <div class="ms-md-auto py-2 py-md-0">
                <a href="{{ route('manage.mak.kro') }}" class="btn btn-danger btn-round">Kembali</a>
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
                <form action="{{ route('manage.mak.kro.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="kode" class="form-label">Kode KRO</label>
                        <input type="text" name="kode" class="form-control" id="kode" value="{{ old('kode') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="kro" class="form-label">Nama KRO</label>
                        <input type="text" name="kro" class="form-control" id="nama_kro" value="{{ old('kro') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="flag" class="form-label">Flag</label>
                        <select name="flag" id="flag" class="form-select">
                            <option value="1" {{ old('flag', 1) == 1 ? 'selected' : '' }}>Tampilkan</option>
                            <option value="0" {{ old('flag', 1) == 0 ? 'selected' : '' }}>Jangan Tampilkan</option>
                        </select>
                    </div>
                    <!-- Tambahkan field lainnya jika diperlukan -->
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
