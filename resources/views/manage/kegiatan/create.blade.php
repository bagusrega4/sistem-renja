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

                    {{-- Pilih kegiatan dari database --}}
                    <div class="mb-3">
                        <label for="kegiatan_id" class="form-label">Pilih Kegiatan</label>
                        <select name="kegiatan_id" id="kegiatan_id" class="form-control" required>
                            <option value="" disabled selected hidden>Pilih kegiatan</option>
                            @foreach($kegiatan as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_kegiatan }}</option>
                            @endforeach
                            <option value="other">+ Tambah Baru</option>
                        </select>
                    </div>

                    {{-- Input manual (hidden default) --}}
                    <div class="mb-3" id="new_kegiatan_wrapper" style="display: none;">
                        <label for="nama_kegiatan" class="form-label">Nama Kegiatan Baru</label>
                        <input type="text" name="nama_kegiatan" id="nama_kegiatan" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi Kegiatan</label>
                        <textarea name="deskripsi" id="deskripsi" rows="4" class="form-control" placeholder="Tuliskan deskripsi kegiatan..."></textarea>
                    </div>

                    {{-- Periode Mulai --}}
                    <div class="mb-3">
                        <label for="periode_mulai" class="form-label">Periode Mulai</label>
                        <input type="date"
                            name="periode_mulai"
                            id="periode_mulai"
                            class="form-control"
                            required
                            min="{{ date('Y-m-d') }}">
                    </div>

                    {{-- Periode Selesai --}}
                    <div class="mb-3">
                        <label for="periode_selesai" class="form-label">Periode Selesai</label>
                        <input type="date"
                            name="periode_selesai"
                            id="periode_selesai"
                            class="form-control"
                            required
                            min="{{ date('Y-m-d') }}">
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('manage.kegiatan.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('kegiatan_id').addEventListener('change', function() {
        let wrapper = document.getElementById('new_kegiatan_wrapper');
        let input = document.getElementById('nama_kegiatan');
        if (this.value === 'other') {
            wrapper.style.display = 'block';
            input.setAttribute('required', 'required');
        } else {
            wrapper.style.display = 'none';
            input.removeAttribute('required');
        }
    });
</script>
@endpush