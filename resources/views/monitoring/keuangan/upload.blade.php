@extends('layouts/app')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h2 class="fw-bold mb-3">Form Tim Keuangan</h2>
                <h6 class="op-7 mb-2">Form Upload File Tim Keuangan BPS Provinsi DKI Jakarta Tahun Anggaran 2024</h6>
            </div>
            <div class="ms-md-auto py-2 py-md-0">
                <a href="{{ route('monitoring.keuangan.index') }}" class="btn btn-danger btn-round">Kembali</a>
            </div>
        </div>

        <div class="card card-round">
            <div class="card-body">
                <form action="{{ route('monitoring.keuangan.storeFile') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" role="form" name="fileOperatorId" value="{{$fileOperator->id}}">
                    <div class="mb-3">
                        <label for="noSPBy" class="form-label">No. SPBy
                            <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            class="form-control"
                            id="noSPBy"
                            name="noSPBy"
                            placeholder="Your answer"
                            required />
                    </div>

                    <div class="mb-3">
                        <label for="noDRPP" class="form-label">No. DRPP
                            <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            class="form-control"
                            id="noDRPP"
                            name="noDRPP"
                            placeholder="Your answer"
                            required />
                    </div>

                    <div class="mb-3">
                        <label for="noSPM" class="form-label">No. SPM
                            <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            class="form-control"
                            id="noSPM"
                            name="noSPM"
                            placeholder="Your answer"
                            required />
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_SPM" class="form-label">Tanggal SPM
                            <span class="text-danger">*</span></label>
                        <input
                            type="date"
                            class="form-control"
                            id="tanggalSPM"
                            name="tanggal_SPM"
                            placeholder="dd/mm/yyyy" />
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_DRPP" class="form-label">Tanggal SP2D
                            <span class="text-danger">*</span></label>
                        <input
                            type="date"
                            class="form-control"
                            id="tanggalSP2D"
                            name="tanggal_DRPP"
                            placeholder="dd/mm/yyyy" />
                    </div>

                    <div class="mb-3">
                        <label for="buktiTransfer" class="form-label">Bukti Transfer</label>
                        <div class="input-group">
                            <input type="file" name="buktiTransfer" class="form-control" id="buktiTransfer" accept=".jpeg,.jpg,.png,.pdf,.doc,.docx,.xls,.xlsx" required onchange="toggleResetButton('buktiTransfer','btn_reset_buktiTransfer')">
                            <button type="button" class="btn btn-outline-danger" id="btn_reset_buktiTransfer" style="display: none;" onclick="resetFileInput('buktiTransfer','btn_reset_buktiTransfer')">X</button>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="spjHonorInnas" class="form-label">SPJ Honor Innas</label>
                        <div class="input-group">
                            <input type="file" name="spjHonorInnas" class="form-control" id="spjHonorInnas" accept=".jpeg,.jpg,.png,.pdf,.doc,.docx,.xls,.xlsx" required onchange="toggleResetButton('spjHonorInnas','btn_reset_spjHonorInnas')">
                            <button type="button" class="btn btn-outline-danger" id="btn_reset_spjHonorInnas" style="display: none;" onclick="resetFileInput('surat_tugas','btn_reset_spjHonorInnas')">X</button>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="sspHonorInnas" class="form-label">SSP Honor Innas</label>
                        <div class="input-group">
                            <input type="file" name="sspHonorInnas" class="form-control" id="sspHonorInnas" accept=".jpeg,.jpg,.png,.pdf,.doc,.docx,.xls,.xlsx" required onchange="toggleResetButton('sspHonorInnas','btn_reset_sspHonorInnas')">
                            <button type="button" class="btn btn-outline-danger" id="btn_reset_sspHonorInnas" style="display: none;" onclick="resetFileInput('sspHonorInnas','btn_reset_sspHonorInnas')">X</button>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="fileLainya" class="form-label">File Tim Keuangan lainnya</label>
                        <div class="input-group">
                            <input type="file" name="fileLainya" class="form-control" id="fileLainya" accept=".jpeg,.jpg,.png,.pdf,.doc,.docx,.xls,.xlsx" required onchange="toggleResetButton('fileLainya','btn_reset_fileLainya')">
                            <button type="button" class="btn btn-outline-danger" id="btn_reset_fileLainya" style="display: none;" onclick="resetFileInput('fileLainya','btn_reset_fileLainya')">X</button>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    function resetFileInput(fileInputId, buttonId) {
        var fileInput = document.getElementById(fileInputId);
        fileInput.value = "";
        document.getElementById(buttonId).style.display = "none";
    }

    function toggleResetButton(fileInputId, buttonId) {
        var fileInput = document.getElementById(fileInputId);
        var button = document.getElementById(buttonId);

        if (fileInput.value) {
            button.style.display = "inline-block";
        } else {
            button.style.display = "none";
        }
    }
</script>
@endsection