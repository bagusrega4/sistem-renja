@extends('layouts/app')
@section('content')
<div class="container">
    
    <div class="page-inner">
        
        <h2 class="fw-bold mb-3">Edit Form</h2>
        <h6 class="op-7 mb-2">
            Edit Form Registrasi Bukti Dukung Administrasi BPS Provinsi DKI Jakarta
        </h6>

        <form action="{{ route('form.update', $formPengajuan->no_fp) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="no_fp" class="form-label">Nomor FP
                    <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control" id="no_fp" name="no_fp" placeholder="Masukkan nomor FP" value="{{$formPengajuan -> no_fp}}" disabled>
            </div>
            <!-- Dropdown Rincian Output -->
            <div class="mb-3">
                <label for="id_output" class="form-label">Rincian Output
                    <span class="text-danger">*</span>
                </label>
                <select class="form-select" id="id_output" name="id_output" required>
                    <option value="" disabled selected hidden>Pilih Rincian Output</option>
                    @foreach ($output as $output)
                    <option value="{{ $output->id }}"
                        {{$formPengajuan->id_output == $output -> id ? 'selected' : ''}}>
                        {{ $output->output }}
                    </option>
                    @endforeach
                </select>
                @error('output')
                <small>{{ $message}}</small>
                @enderror
            </div>

            <!-- Dropdown Komponen -->
            <div class="mb-3">
                <label for="kode_komponen" class="form-label">Komponen
                    <span class="text-danger">*</span>
                </label>
                <select class="form-select" id="kode_komponen" name="kode_komponen" required>
                    <option value="" disabled selected hidden>Pilih Komponen</option>
                    @foreach ($komponen as $item)
                    <option value="{{ $item->kode }}"
                    {{$formPengajuan->kode_komponen == $item -> kode ? 'selected' : ''}}>
                    {{ $item->komponen }}
                </option>
                    @endforeach
                </select>
            </div>

            <!-- Dropdown Sub Komponen -->
            <div class="mb-3">
                <label for="kode_subkomponen" class="form-label">Sub Komponen
                    <span class="text-danger">*</span>
                </label>
                <select class="form-select" id="kode_subkomponen" name="kode_subkomponen" required>
                    <option value="" disabled selected hidden>Pilih Sub Komponen</option>
                    @foreach ($subKomponen as $item)
                    <option value="{{ $item->kode }}"
                    {{$formPengajuan->kode_subkomponen == $item -> kode ? 'selected' : ''}}>
                    {{ $item->sub_komponen}}
                </option>
                    @endforeach
                </select>
            </div>

            <!-- Dropdown Akun -->
            <div class="mb-3">
                <label for="kode_akun" class="form-label">Akun
                    <span class="text-danger">*</span>
                </label>
                <select class="form-select" id="kode_akun" name="kode_akun" required>
                    <option value="" disabled selected hidden>Pilih Akun</option>
                    @foreach ($akunBelanja as $item)
                        <option value="{{ $item->kode }}"
                        {{$formPengajuan->kode_akun == $item -> kode ? 'selected' : ''}}>
                        {{ $item->akun_belanja }}
                    </option>
                    @endforeach
                </select>
            </div>

            <!-- Input Lainnya -->
            <div class="mb-3">
                <label for="tanggal_mulai" class="form-label">Tanggal Mulai Kegiatan
                    <span class="text-danger">*</span>
                </label>
                <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" value="{{$formPengajuan->tanggal_mulai}}" required>
            </div>

            <div class="mb-3">
                <label for="tanggal_akhir" class="form-label">Tanggal Akhir Kegiatan
                    <span class="text-danger">*</span>
                </label>
                <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir" value="{{$formPengajuan->tanggal_akhir}}" required>
            </div>

            <div class="mb-3">
                <label for="no_sk" class="form-label">Nomor SK/Surat Tugas
                    <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control" id="no_sk" name="no_sk" placeholder="Masukkan nomor SK" value="{{$formPengajuan->no_sk}}" required>
            </div>

            <div class="mb-3">
                <label for="uraian" class="form-label">Uraian
                    <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control" id="uraian" name="uraian" placeholder="Masukkan uraian" value="{{$formPengajuan->uraian}}" required>
            </div>

            <div class="mb-3">
                <label for="nominal" class="form-label">Nominal
                    <span class="text-danger">*</span>
                </label>
                <input type="number" class="form-control" id="nominal" name="nominal" placeholder="Masukkan nominal" value="{{$formPengajuan->nominal}}" required>
            </div>

            <button type="submit" class="btn btn-success">Kirim</button>
        </form>
    </div>
</div>
@endsection