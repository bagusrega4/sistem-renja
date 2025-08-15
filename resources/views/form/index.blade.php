@extends('layouts/app')

@section('stylecss')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
@endsection

@section('content')
<div class="container">
    <div class="page-inner">

        <h2 class="fw-bold mb-3">Form Tambah Rencana Kerja</h2>

        {{-- Tampilkan error validasi --}}
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('form.store') }}" method="POST">
            @csrf {{-- Pastikan CSRF token selalu ada --}}

            <!-- Pilih Tim -->
            @if(auth()->user()->id_role == 1)
            {{-- Role 1: Bisa memilih tim (kecuali pimpinan) --}}
            <div class="mb-3">
                <label for="tim_id" class="form-label">Pilih Tim <span class="text-danger">*</span></label>
                <select class="form-select" id="tim_id" name="tim_id" required>
                    <option value="" disabled selected hidden>Pilih Tim</option>
                    @foreach ($timList as $tim)
                    @if ($tim->id != 9)
                    <option value="{{ $tim->id }}" {{ old('tim_id') == $tim->id ? 'selected' : '' }}>
                        {{ $tim->nama_tim }}
                    </option>
                    @endif
                    @endforeach
                </select>
            </div>
            @elseif(in_array(auth()->user()->id_role, [2, 3]))
            {{-- Role 2 & 3: tim otomatis dari user, tidak tampilkan dropdown --}}
            @if(auth()->user()->tim_id != 9)
            <input type="hidden" name="tim_id" value="{{ auth()->user()->tim_id }}">
            @endif
            @endif

            <!-- Pilih Kegiatan -->
            <div class="mb-3">
                <label for="kegiatan_id" class="form-label">Pilih Kegiatan <span class="text-danger">*</span></label>
                <select class="form-select" id="kegiatan_id" name="kegiatan_id" required>
                    <option value="" disabled selected hidden>Pilih Kegiatan</option>
                    @foreach ($kegiatanList as $kegiatan)
                    <option value="{{ $kegiatan->id }}" {{ old('kegiatan_id') == $kegiatan->id ? 'selected' : '' }}>
                        {{ $kegiatan->nama_kegiatan }}
                    </option>
                    @endforeach
                </select>
            </div>

            <!-- Tanggal -->
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ old('tanggal') }}" required>
            </div>

            <!-- Jam Kegiatan -->
            <div class="mb-3">
                <label class="form-label">Pukul <span class="text-danger">*</span></label>
                <div class="row g-2">
                    <div class="col-md-6">
                        <label>Jam Mulai</label>
                        <input type="time" class="form-control" name="jam_mulai" value="{{ old('jam_mulai') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label>Jam Akhir</label>
                        <input type="time" class="form-control" name="jam_akhir" value="{{ old('jam_akhir') }}" required>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection