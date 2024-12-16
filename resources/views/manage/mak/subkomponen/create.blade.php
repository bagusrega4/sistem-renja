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
                <h2 class="fw-bold mb-3">Tambah Sub Komponen</h2>
                <h6 class="op-7 mb-2">Menambahkan Sub Komponen Baru</h6>
            </div>
            <div class="ms-md-auto py-2 py-md-0">
                <a href="{{ route('manage.mak.subkomponen') }}" class="btn btn-secondary btn-round">Kembali</a>
            </div>
        </div>

        <div class="card card-round">
            <div class="card-body">
                <form action="{{ route('manage.mak.subkomponen.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="kode" class="form-label">Kode Sub Komponen</label>
                        <input type="text" name="kode" class="form-control" id="kode" value="{{ old('kode') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="sub_komponen" class="form-label">Nama Sub Komponen</label>
                        <input type="text" name="sub_komponen" class="form-control" id="sub_komponen" value="{{ old('sub_komponen') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="flag" class="form-label">Flag</label>
                        <select name="flag" id="flag" class="form-select" required>
                            <option value="1" {{ old('flag') == 1 ? 'selected' : '' }}>Tampilkan</option>
                            <option value="0" {{ old('flag') == 0 ? 'selected' : '' }}>Jangan Tampilkan</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
