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
                                    <button class="btn btn-icon btn-clean me-0" type="button" id="dropdownMenuButton"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-filter"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#">Range Tanggal</a>
                                        <a class="dropdown-item" href="#">Akun Belanja</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table id="example" class="table table-striped" style="width:100%">
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
                                <tbody>
                                    @foreach ($formPengajuan as $fp)
                                        <tr>
                                            <th scope="row">
                                                {{ $loop->iteration }}
                                            </th>
                                            <td class="text-end">{{ $fp->no_fp }}</td>
                                            <td class="text-start">{{ $fp->uraian }}</td>
                                            <td class="text-end">{{ $fp->tanggal_mulai }} s.d. {{ $fp->tanggal_akhir }}</td>
                                            <td class="text-end">
                                                <div class="d-flex justify-content-end">
                                                    <button type="button" class="btn btn-primary btn-sm me-2"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#viewModalCenter{{ $fp->id }}"
                                                        data-bs-no-fp="{{ $fp->id }}">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    @if($fp->id_status == 1)
                                                    <button class="btn btn-secondary btn-sm me-2"
                                                        onclick="window.location.href='{{ route('form.edit', $fp->id) }}'">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    @endif
                                                    <button class="btn btn-info btn-sm me-2"
                                                        onclick="window.location.href='{{ route('monitoring.operator.upload', $fp->id) }}'">
                                                        <i class="fas fa-desktop"></i>
                                                    </button>

                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteModalCenter-{{ $fp->id }}">
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

<!-- Modal View wkwk-->
@section('modal-view')
    @foreach ($formPengajuan as $fp)
        <div class="modal fade" id="viewModalCenter{{ $fp->id }}" tabindex="-1" role="dialog"
            aria-labelledby="viewModalCenterTitle" aria-labelledby="viewModalCenterTitle{{ $fp->id }}"
            aria-hidden="true">
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
                                    <td class="text-start">{{ $fp->no_fp }}</td>
                                    <td class="text-start"><strong>{{ $fp->uraian }}</strong></td>
                                    <td class="text-start">
                                        [{{ $fp->output->kegiatan->kode }}.{{ $fp->output->kro->kode }}.{{ $fp->output->kode_ro }}]
                                        {{ $fp->output->output }}</td>
                                    <td class="text-start">{{ $fp->komponen->komponen }}</td>
                                    <td class="text-start">{{ $fp->subKomponen->sub_komponen }}</td>
                                    <td class="text-start">{{ $fp->akunBelanja->nama_akun }}</td>
                                    <td class="text-start">{{ $fp->tanggal_mulai }} s.d. {{ $fp->tanggal_akhir }}</td>
                                    <td class="text-start">{{ $fp->no_sk }}</td>
                                    <td class="text-start nominal-currency">{{ $fp->nominal }}</td>
                                    <td class="text-center">{{ $fp->rejection_note ?? '-' }}</td>
                                    <td class="text-start">
                                        @if ($fp->id_fk != null)
                                        <button type="button" class="btn btn-primary btn-sm me-2" data-bs-toggle="modal"
                                            data-bs-target="#previewModal" title="Preview Bukti Pengajuan">
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
    </script>
@endpush

<!-- Modal Delete -->
@section('modal-delete')
    @foreach ($formPengajuan as $fp)
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
