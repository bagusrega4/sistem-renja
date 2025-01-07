@extends('layouts/app')
@section('content')
<div class="container">
    <div class="page-inner">

        <h2 class="fw-bold mb-3">Form</h2>
        <h6 class="op-7 mb-2">
            Form Registrasi Bukti Dukung Administrasi BPS Provinsi DKI Jakarta Tahun Anggaran 2024
        </h6>

        <form action="{{ route('form.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="no_fp" class="form-label">Nomor FP
                    <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control" id="no_fp" name="no_fp" placeholder="Masukkan nomor FP" required>
                @error('output')
                <small>{{ $message}}</small>
                @enderror
            </div>
            <!-- Dropdown Rincian Output -->
            <div class="mb-3">
                <label for="id_output" class="form-label">Rincian Output
                    <span class="text-danger">*</span>
                </label>
                <select class="form-select" id="id_output" name="id_output" required>
                    <option value="" disabled selected hidden>Pilih Rincian Output</option>
                    @foreach ($output as $item)
                    <option value="{{ $item->id }}">[{{ $item->kegiatan->kode }}.{{ $item->kro->kode }}.{{ $item->kode_ro }}]     {{ $item->output }}</option>
                    @endforeach
                </select>
                @error('output')
                <small>{{ $message}}</small>
                @enderror
            </div>

            <!-- Dropdown Komponen -->
            <div class="mb-3">
                <label for="id_komponen" class="form-label">Komponen
                    <span class="text-danger">*</span>
                </label>
                <select class="form-select" id="id_komponen" name="id_komponen" required>
                    <option value="" disabled selected hidden>Pilih Komponen</option>
                    @foreach ($komponen as $item)
                    <option value="{{ $item->id }}">[{{ $item->kode }}]   {{ $item->komponen }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Dropdown Sub Komponen -->
            <div class="mb-3">
                <label for="id_subkomponen" class="form-label">Sub Komponen
                    <span class="text-danger">*</span>
                </label>
                <select class="form-select" id="id_subkomponen" name="id_subkomponen" required>
                    <option value="" disabled selected hidden>Pilih Sub Komponen</option>
                    @foreach ($subKomponen as $item)
                    <option value="{{ $item->id }}">[{{ $item->kode }}]   {{ $item->sub_komponen}}</option>
                    @endforeach
                </select>
            </div>

            <!-- Dropdown Akun -->
            <div class="mb-3">
                <label for="id_akun_belanja" class="form-label">Akun Belanja
                    <span class="text-danger">*</span>
                </label>
                <select class="form-select" id="id_akun_belanja" name="id_akun_belanja" required>
                    <option value="" disabled selected hidden>Pilih Akun Belanja</option>
                    @foreach ($akunBelanja as $item)
<<<<<<< HEAD
                    <option value="{{ $item->id }}">[{{ $item->kode }}]   {{ $item->nama_akun }}</option>
=======
                    <option value="{{ $item->kode }}">{{ $item->kode }} - {{ $item->akun_belanja }}</option>
>>>>>>> e801f44bb8043adf54c86d10e519d78cfea5ec56
                    @endforeach
                </select>
            </div>

            <!-- Input Lainnya -->
            <div class="mb-3">
                <label for="tanggal_mulai" class="form-label">Tanggal Mulai Kegiatan
                    <span class="text-danger">*</span>
                </label>
                <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" required>
            </div>

            <div class="mb-3">
                <label for="tanggal_akhir" class="form-label">Tanggal Akhir Kegiatan
                    <span class="text-danger">*</span>
                </label>
                <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir" required>
            </div>

            <div class="mb-3">
                <label for="no_sk" class="form-label">Nomor SK/Surat Tugas
                    <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control" id="no_sk" name="no_sk" placeholder="Masukkan nomor SK" required>
            </div>

            <div class="mb-3">
                <label for="uraian" class="form-label">Uraian
                    <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control" id="uraian" name="uraian" placeholder="Masukkan uraian" required>
            </div>

            <div class="mb-3">
                <label for="nominal" class="form-label">Nominal
                    <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control" id="nominal" name="nominal" placeholder="Masukkan nominal" required>
            </div>

            <button type="submit" class="btn btn-success">Kirim</button>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    const input = document.getElementById("nominal");
<<<<<<< HEAD
    const formatter = new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
        minimumFractionDigits: 0,
        maximumFractionDigits: 0
    });

    input.addEventListener("input", (e) => {
        const rawValue = input.value.replace(/[^\d]/g, "");

        if (rawValue) {
            input.value = formatter.format(rawValue).replace(/\s+/g, "");
        } else {
            input.value = "";
        }

        input.dataset.rawValue = rawValue;
    });
</script>
@endsection

=======
    const formatter = new Intl.NumberFormat("id-ID");

    input.addEventListener("input", (e) => {
        const rawValue = input.value.replace(/[^\d]/g, "");
        input.value = rawValue ? formatter.format(rawValue) : "";
        input.dataset.rawValue = rawValue;
    });
</script>
@endsection
>>>>>>> e801f44bb8043adf54c86d10e519d78cfea5ec56
