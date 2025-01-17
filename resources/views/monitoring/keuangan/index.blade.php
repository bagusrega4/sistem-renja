@extends('layouts/app')
@section('content')
<div class="container">
    <div class="page-inner">
        <!-- Notifikasi Sukses -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div
            class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h2 class="fw-bold mb-3">Monitoring Keuangan</h2>
                <h6 class="op-7 mb-2">Monitoring pengajuan yang diajukan oleh Operator</h6>
            </div>
            <!-- <div class="ms-md-auto py-2 py-md-0">
                <a href="{{ route('form.index') }}" class="btn btn-label-info btn-round me-2">Monitoring File</a>
                <a href="form_keuangan.html" class="btn btn-primary btn-round">Tambah Pengajuan</a>
            </div> -->
        </div>
        <div class="col-md-12">
            <div class="card card-round">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                        <div class="card-title">Tabel Monitoring</div>
                        <div class="card-tools">
                            <div class="dropdown">
                                <button
                                    class="btn btn-clean me-0"
                                    type="button"
                                    id="dropdownMenuButton"
                                    data-bs-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="fas fa-filter"></i>
                                    Filter akun
                                </button>
                                <ul id="filterakun" class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    @foreach($akunBelanja as $ab)
                                    <li class="dropdown-item">
                                        <input type="checkbox" class="filter-checkbox" value="{{ $ab->id }}" />
                                        [{{ $ab->kode }}] - {{ $ab->nama_akun }}
                                    </li>
                                    @endforeach
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table id="table-monitoring" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>No. FP</th>
                                    <th>Nama Permintaan</th>
                                    <th>Tanggal Kegiatan</th>
                                    <th>PJ Berkas</th>
                                    <th>Aksi</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="tbody-monitoring">
                                @php
                                $counter = 1;
                                @endphp
                                @foreach ($pengajuan as $p)
                                <tr>
                                    <th scope="row">
                                        {{ $counter++ }}
                                    </th>
                                    <td class="text-end">{{ $p->no_fp }}</td>
                                    <td class="text-start">{{ $p->uraian }}</td>
                                    <td class="text-end">{{ $p->tanggal_mulai }} s.d. {{ $p->tanggal_akhir }}</td>
                                    <td class="text-end">{{ $p->pegawai->nama }}</td>
                                    <td class="text-end">
                                        <div class="d-flex justify-content-end">
                                            <button type="button" class="btn btn-primary btn-sm me-2"
                                                data-bs-toggle="modal"
                                                data-bs-target="#viewModalCenter{{ $p->id }}"
                                                data-bs-id="{{ $p->id }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <a class="btn btn-info btn-sm me-2"
                                                href="{{ route('monitoring.keuangan.file', $p->id) }}">
                                                <i class="fas fa-desktop"></i>
                                            </a>
                                            @if (in_array($p->id_status, [4, 5]))
                                            <a class="btn btn-success btn-sm me-2"
                                                aria-label="upload file"
                                                href="{{ route('monitoring.keuangan.upload', $p->id) }}">
                                                <i class="fas fa-upload"></i>
                                            </a>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        @switch($p->id_status)
                                        @case(1)
                                        <span class="badge bg-light text-dark">{{ $p->statusPengajuan->status }}</span>
                                        @break
                                        @case(2)
                                        <span class="badge bg-warning">{{ $p->statusPengajuan->status }}</span>
                                        @break
                                        @case(3)
                                        <span class="badge bg-danger">{{ $p->statusPengajuan->status }}</span>
                                        @break
                                        @case(4)
                                        <span class="badge bg-primary">{{ $p->statusPengajuan->status }}</span>
                                        @break
                                        @case(5)
                                        <span class="badge bg-success fw-bold">{{ $p->statusPengajuan->status }}</span>
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
    </div>
</div>
@endsection

@section('modal-view')
@foreach($pengajuan as $fp)
<div class="modal fade" id="viewModalCenter{{ $fp->id }}" tabindex="-1" role="dialog" aria-labelledby="viewModalCenterTitle" aria-labelledby="viewModalCenterTitle{{ $fp->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalCenterTitle">View Pengajuan</h5>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>No. FP</th>
                                <th>Nama Permintaan</th>
                                <th>Rincian Output</th>
                                <th>Komponen</th>
                                <th>Sub Komponen</th>
                                <th>Akun</th>
                                <th>Tanggal Kegiatan</th>
                                <th>No. SK</th>
                                <th>Nominal</th>
                                <th>Catatan</th>
                                <th>Bukti Transfer</th>
                            </tr>
                        </thead>
                        <tbody>
                            <td class="text-start">{{$fp -> no_fp}}</td>
                            <td class="text-start"><strong>{{ $fp->uraian }}</strong></td>
                            <td class="text-start">[{{$fp -> output -> kegiatan -> kode}}.{{$fp -> output -> kro -> kode}}.{{$fp -> output -> kode_ro}}] {{$fp -> output -> output}}</td>
                            <td class="text-start">{{$fp -> komponen -> komponen}}</td>
                            <td class="text-start">{{$fp -> subKomponen -> sub_komponen}}</td>
                            <td class="text-start">{{$fp -> akunBelanja -> nama_akun}}</td>
                            <td class="text-start">{{$fp -> tanggal_mulai}} s.d. {{$fp -> tanggal_akhir}}</td>
                            <td class="text-start">{{$fp -> no_sk}}</td>
                            <td class="text-start nominal-currency">{{ $fp-> nominal }}</td>
                            <td class="text-center">{{ $fp->rejection_note ?? '-' }}</td>
                            <td class="text-start">
                                @if ($fp->fileUploadKeuangan->where('akunFileKeuangan.jenisFileKeuangan.id', 12)->first())
                                <button type="button" class="btn btn-primary btn-sm me-2" onclick="previewBuktiTransfer({{ $fp->id }})"
                                    title="Preview Bukti Transfer">
                                    <i class="fas fa-eye"></i>
                                </button>
                                @else
                                -
                                @endif
                            </td>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection

@section('modal-preview')
<div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="previewModalLabel">Preview Bukti Transfer</h5>
            </div>
            <div class="modal-body">
                <iframe id="previewFileFrame" src="" style="width: 100%; height: 600px;" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        function get_filter() {
            var filter = [];
            $('#filterakun input.filter-checkbox:checked').each(function() {
                filter.push($(this).val());
            });
            return filter;
        }

        function filter_data() {
            var selectedFilters = get_filter(); // Fungsi untuk mendapatkan nilai filter (checkbox yang dicentang)

            // Sembunyikan tabel sebelum memuat data baru
            $('#table-monitoring').hide(); // Ganti #table-monitoring dengan ID tabel Anda

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/short', // Endpoint untuk filter data
                type: 'GET',
                data: {
                    filters: selectedFilters
                },
                success: function(response) {
                    // Perbarui isi <tbody> dengan data yang dikembalikan
                    $('#tbody-monitoring').html(response.html);

                    // Tampilkan tabel setelah data dimuat
                    $('#table-monitoring').show();
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);

                    // Tampilkan tabel meskipun terjadi error untuk debugging
                    $('#table-monitoring').show();
                }
            });
        }

        // Event listener untuk checkbox
        $('input[type="checkbox"]').on('change', function() {
            filter_data(); // Panggil fungsi filter_data() setiap kali checkbox diubah
        });
    });
</script>
@endpush

@push('scripts')
<script>
    function formatRupiah(number) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }).format(number).replace(/\s+/g, "");
    }

    document.addEventListener('DOMContentLoaded', function() {
        const nominalElements = document.querySelectorAll('.nominal-currency');
        nominalElements.forEach(element => {
            const rawValue = element.textContent;
            element.textContent = formatRupiah(rawValue);
        });
    });

    function previewBuktiTransfer(idFormPengajuan) {
        fetch(`/monitoring/keuangan/get-bukti-transfer/${idFormPengajuan}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Bukti transfer tidak ditemukan');
                }
                return response.json();
            })
            .then(data => {
                const fileFrame = document.getElementById('previewFileFrame');
                if (!fileFrame) {
                    console.error("Elemen 'previewFileFrame' tidak ditemukan di DOM.");
                    return;
                }
                fileFrame.src = `/storage/${data.file_path}`;
                const previewModal = new bootstrap.Modal(document.getElementById('previewModal'));
                previewModal.show();
            })
            .catch(error => {
                alert(error.message);
            });
    }
</script>
@endpush