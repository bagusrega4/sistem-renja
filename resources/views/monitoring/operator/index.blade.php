@extends('layouts/app')
@section('content')
<div class="container">
    <div class="page-inner">
        <!-- Notifikasi Sukses -->
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h2 class="fw-bold mb-3">Monitoring</h2>
                <h6 class="op-7 mb-2">Monitoring Rincian Kegiatan</h6>
            </div>
            <div class="ms-md-auto py-2 py-md-0">
                <a href="{{ route('form.index') }}" class="btn btn-primary btn-round">Tambah Pengajuan</a>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card card-round">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                        <div class="card-title">Tabel Monitoring</div>
                        <div class="card-tools">
                            <div class="dropdown">
                                <button class="btn btn-clean me-0" type="button" id="dropdownMenuButton"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                        <!-- Projects table -->
                        <table id="example" id="table-monitoring" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>No. FP</th>
                                    <th>Nama Permintaan</th>
                                    <th>Tanggal Kegiatan</th>
                                    <th>Aksi</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="tbody-monitoring">
                                @foreach ($pengajuan as $fp)
                                <tr>
                                    <th scope="row">
                                        {{ $loop->iteration }}
                                    </th>
                                    <td class="text-end">{{ $fp->no_fp }}</td>
                                    <td class="text-start">{{ $fp->uraian }}</td>
                                    <td class="text-start">
                                        {{ \Carbon\Carbon::parse($fp->tanggal_mulai)->translatedFormat('d M Y') }}
                                        s.d.
                                        {{ \Carbon\Carbon::parse($fp->tanggal_akhir)->translatedFormat('d M Y') }}
                                    </td>
                                    <td class="text-end">
                                        <div class="d-flex justify-content-end">
                                            <button type="button" class="btn btn-primary btn-sm me-2"
                                                data-bs-toggle="modal"
                                                data-bs-target="#viewModalCenter{{ $fp->id }}"
                                                data-bs-no-fp="{{ $fp->id }}"
                                                title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            @if($fp->id_status == 1)
                                            <button class="btn btn-secondary btn-sm me-2"
                                                onclick="window.location.href='{{ route('form.edit', $fp->id) }}'"
                                                title="Edit Form Pengajuan">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            @endif
                                            <button class="btn btn-info btn-sm me-2"
                                                onclick="window.location.href='{{ route('monitoring.operator.upload', $fp->id) }}'"
                                                title="Upload File Operator">
                                                <i class="fas fa-desktop"></i>
                                            </button>

                                            <button type="button" class="btn btn-danger btn-sm"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteModalCenter-{{ $fp->id }}"
                                                title="Hapus Form Pengajuan">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="text-start">
                                        @switch($fp->id_status)
                                        @case(1)
                                        <span
                                            class="badge bg-light text-dark">{{ $fp->statusPengajuan->status }}</span>
                                        @break

                                        @case(2)
                                        <span class="badge bg-warning">{{ $fp->statusPengajuan->status }}</span>
                                        @break

                                        @case(3)
                                        <span class="badge bg-danger">{{ $fp->statusPengajuan->status }}</span>
                                        @break

                                        @case(4)
                                        <span class="badge bg-primary">{{ $fp->statusPengajuan->status }}</span>
                                        @break

                                        @case(5)
                                        <span
                                            class="badge bg-success fw-bold">{{ $fp->statusPengajuan->status }}</span>
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
        fetch(`/monitoring/operator/get-bukti-transfer/${idFormPengajuan}`)
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

<!-- Modal Delete -->
@section('modal-delete')
@foreach ($pengajuan as $fp)
<div class="modal fade" id="deleteModalCenter-{{ $fp->id }}" tabindex="-1"
    aria-labelledby="deleteModalLabel-{{ $fp->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel-{{ $fp->id }}">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus form pengajuan ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Batal</button>
                <form action="{{ route('form.delete', $fp->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        // Fungsi untuk mendapatkan filter yang dipilih
        function get_filter() {
            var filter = [];
            $('#filterakun input.filter-checkbox:checked').each(function() {
                filter.push($(this).val());
            });
            return filter;
        }

        // Fungsi untuk menambahkan scroll jika jumlah item melebihi batas
        function add_scroll_to_dropdown() {
            var dropdownMenu = $('#filterakun');
            var itemCount = dropdownMenu.find('li').length;
            var maxItems = 40;

            if (itemCount > maxItems) {
                dropdownMenu.css({
                    'max-height': '300px',
                    'overflow-y': 'auto'
                });
            } else {
                dropdownMenu.css({
                    'max-height': '',
                    'overflow-y': ''
                });
            }
        }

        // Fungsi untuk melakukan filter data
        function filter_data() {
            var selectedFilters = get_filter();
            $('#table-monitoring').hide();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/short2',
                type: 'GET',
                data: {
                    filters: selectedFilters
                },
                success: function(response) {
                    $('#tbody-monitoring').html(response.html);
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }

        // Menambahkan scroll setelah dropdown ditampilkan
        $('#dropdownMenuButton').on('click', function() {
            setTimeout(function() {
                add_scroll_to_dropdown();
            }, 100);
        });

        // Menjalankan filter data saat checkbox diubah
        $('input[type="checkbox"]').on('change', function() {
            filter_data();
        });
    });
</script>
@endpush
