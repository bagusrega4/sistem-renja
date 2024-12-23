@extends('layouts.app')
@section('content')
<div class="container">
    <div class="page-inner">
        <!-- Heading & Filter -->
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h2 class="fw-bold mb-3">Download</h2>
                <h6 class="op-7 mb-2">Download Pengajuan Bukti Dukung Administrasi (BDA)</h6>
            </div>
        </div>

        <!-- Filter Form -->
        <form method="GET" action="{{ route('download.index') }}">
            <div class="d-flex justify-content-between">
                <div class="mb-3" style="flex: 1; margin-right: 20px">
                    <label for="tanggalMulai" class="form-label">Tanggal Mulai Kegiatan</label>
                    <input type="date" class="form-control" name="tanggal_mulai" id="tanggalMulai" value="{{ request('tanggal_mulai') }}" />
                </div>
                <div class="mb-3" style="flex: 1">
                    <label for="tanggalAkhir" class="form-label">Tanggal Akhir Kegiatan</label>
                    <input type="date" class="form-control" name="tanggal_akhir" id="tanggalAkhir" value="{{ request('tanggal_akhir') }}" />
                </div>
            </div>

            <div class="mb-3">
                <label for="akun" class="form-label">Akun</label>
                <select class="form-select" name="akun" id="akun" style="max-width: 618px">
                    <option value="">Pilih Akun</option>
                    @foreach($akunBelanja as $itemAkun)
                    <option value="{{ $itemAkun->kode }}" {{ request('akun') == $itemAkun->kode ? 'selected' : '' }}>
                        {{ $itemAkun->kode }} - {{ $itemAkun->akun_belanja }}
                    </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-round">Filter</button>
        </form>

        <!-- Tabel Monitoring dengan Check All -->
        <form method="POST" action="{{ route('download.proses') }}">
            @csrf
            <div class="col-md-12 mt-4">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">Tabel Monitoring</div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table id="example" class="table table-striped" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="checkAll" style="transform: scale(1.5);" /></th>
                                        <th>No.</th>
                                        <th>No. FP</th>
                                        <th>Tanggal Kegiatan</th>
                                        <th>Nama Permintaan</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($formPengajuan as $index => $item)
                                    <tr>
                                        <td><input type="checkbox" name="selected_ids[]" value="{{ $item->no_fp }}" class="form-check-input" style="transform: scale(1.5);" /></td>
                                        <td>{{ $index + 1 }}</td>
                                        <td class="text-end">{{ $item->no_fp }}</td>
                                        <td class="text-end">{{ $item->tanggal_mulai }} s.d. {{ $item->tanggal_akhir }}</td>
                                        <td class="text-end">{{ $item->uraian }}</td>
                                        <td class="text-end">
                                            @switch($item->status)
                                                @case(\App\Enums\Status::ENTRI_DOKUMEN)
                                                    <span class="badge bg-light text-dark">Entri Dokumen</span>
                                                    @break

                                                @case(\App\Enums\Status::PENGECEKAN_DOKUMEN)
                                                    <span class="badge bg-warning">Pengecekan Dokumen</span>
                                                    @break

                                                @case(\App\Enums\Status::DITOLAK)
                                                    <span class="badge bg-danger">Ditolak</span>
                                                    @break

                                                @case(\App\Enums\Status::DISETUJUI)
                                                    <span class="badge bg-primary">Disetujui</span>
                                                    @break

                                                @case(\App\Enums\Status::SELESAI)
                                                    <span class="badge bg-success fw-bold">Selesai</span>
                                                    @break

                                                @default
                                                    <span class="badge bg-warning text-dark">Status Tidak Dikenal</span>
                                            @endswitch
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end align-items-center mt-3 flex-nowrap">
                <div class="me-4 d-flex align-items-center flex-nowrap">
                    <label for="format" class="form-label me-2 mb-0" style="white-space: nowrap;">Format File</label>
                    <select class="form-select" name="format" id="format" style="max-width: 100px;">
                        <option value="csv">CSV</option>
                        <option value="xlsx">XLSX</option>
                    </select>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary btn-round">Download yang Dipilih</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- JavaScript untuk Check All -->
<script>
    document.getElementById('checkAll').addEventListener('click', function(event) {
        var checkboxes = document.querySelectorAll('input[name="selected_ids[]"]');
        checkboxes.forEach(checkbox => checkbox.checked = event.target.checked);
    });
</script>
@endsection
