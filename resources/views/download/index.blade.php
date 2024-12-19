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
                    @foreach($akunBelanja as $akun)
                    <option value="{{ $akun->kode }}" {{ request('akun') == $akun->kode ? 'selected' : '' }}>
                        {{ $akun->kode }} - {{ $akun->akun_belanja }}
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
                                        <td class="text-end">{{ $item->tanggal_mulai }} - {{ $item->tanggal_akhir }}</td>
                                        <td class="text-end">{{ $item->uraian }}</td>
                                        <td class="text-end">
                                            <span class="badge {{ $item->status == 'Pengecekan Dokumen' ? 'badge-warning' : ($item->status == 'Entri Operator' ? 'badge-secondary' : ($item->status == 'Proses Pembayaran' ? 'badge-primary' : 'badge-success')) }}">
                                                {{ $item->status }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div class="ms-md-auto py-2 py-md-0">
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