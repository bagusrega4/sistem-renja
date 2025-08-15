@extends('layouts.app')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="card card-round">
            <div class="card-header">
                <h4 class="card-title mb-0">Tambah Kegiatan</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('manage.kegiatan.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_kegiatan" class="form-label">Nama Kegiatan</label>
                        <input type="text" name="nama_kegiatan" id="nama_kegiatan" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi Kegiatan</label>
                        <textarea name="deskripsi" id="deskripsi" rows="4" class="form-control" placeholder="Tuliskan deskripsi kegiatan..."></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('manage.kegiatan.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection