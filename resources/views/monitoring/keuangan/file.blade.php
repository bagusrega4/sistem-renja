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
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <a href="{{ route('monitoring.keuangan.index') }}" class="btn btn-dark mb-4">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
                <h3 class="fw-bold mb-3">Monitoring File</h3>
                <h6 class="op-7 mb-2">Monitoring pada berkas yang telah di-upload operator dan beri persetujuan untuk pengajuan</h6>
            </div>
        </div>
        <!-- Tabel Monitoring -->
        <div class="col-md-12">
            <div class="card card-round">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                        <div class="card-title">{{ $pengajuan->uraian }}</div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Dokumen</th>
                                    <th>Lihat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($uploadedJenisFiles as $index => $jenisFile)
                                    @php
                                        $file = $uploadedFiles->get($jenisFile->id);
                                    @endphp
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $jenisFile->nama_file }}</td>
                                        <td>
                                            @if($file)
                                                <!-- Tombol untuk membuka modal -->
                                                <button type="button"
                                                        class="btn btn-primary btn-sm me-2"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalViewFile{{ $index }}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="modalViewFile{{ $index }}" tabindex="-1"
                                                     aria-labelledby="modalViewFileLabel{{ $index }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="modalViewFileLabel{{ $index }}">
                                                                    File {{ $jenisFile->nama_file }}
                                                                </h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body text-center">
                                                                @if (Str::endsWith($file->file, '.pdf'))
                                                                    <iframe src="{{ asset('storage/' . $file->file) }}"
                                                                            style="width:100%; height:600px;"
                                                                            frameborder="0">
                                                                    </iframe>
                                                                @elseif (in_array(Str::lower(pathinfo($file->file, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif']))
                                                                    <img src="{{ asset('storage/' . $file->file) }}" alt="File" class="img-fluid" />
                                                                @else
                                                                    <p>Tidak dapat menampilkan pratinjau untuk jenis file ini.</p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <span class="text-danger">File belum diupload</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">Tidak ada file yang diupload.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Bagian Approve/Reject -->
            @switch($pengajuan->id_status)
                @case(1)
                @case(2)
                    <div class="d-flex justify-content-end mt-4">
                        <button type="button" class="btn btn-danger btn-round me-2" data-bs-toggle="modal" data-bs-target="#catatanModalCenter">
                            <i class="fas fa-times"></i> Reject Pengajuan
                        </button>
                        <form action="{{ route('monitoring.keuangan.approve', $pengajuan->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-success btn-round">
                                <i class="fas fa-check"></i> Approve Pengajuan
                            </button>
                        </form>
                    </div>
                    @break
                @case(3)
                    <div class="alert alert-danger d-flex align-items-center mt-2" role="alert">
                        <i class="fas fa-ban fa-2x me-2"></i>
                        <div>
                            <strong>Pengajuan telah Ditolak.</strong>
                            Mohon tunggu operator melakukan perbaikan dokumen.
                        </div>
                    </div>
                    @break
                @case(4)
                    <div class="alert alert-success d-flex align-items-center mt-2" role="alert">
                        <i class="fas fa-check-circle fa-2x me-2"></i>
                        <div>
                            <strong>Pengajuan telah Disetujui.</strong>
                            Mohon isi <a href="{{ route('monitoring.keuangan.upload', $pengajuan->id) }}"><strong>form keuangan</strong></a>.
                        </div>
                    </div>
                    @break
                @case(5)
                    <div class="alert alert-info d-flex align-items-center mt-2" role="alert">
                        <i class="fas fa-check-double fa-2x me-2"></i>
                        <div>
                            <strong>Pengajuan telah Selesai.</strong>
                            Semua proses dan verifikasi sudah tuntas.
                        </div>
                    </div>
                    @break
                @default
                    <div class="alert alert-secondary d-flex align-items-center mt-2" role="alert">
                        <i class="fas fa-exclamation-circle fa-2x me-2"></i>
                        <div>
                            <strong>Tidak dapat diapprove maupun direject</strong>,
                            karena status pengajuan saat ini tidak memenuhi kriteria perubahan.
                        </div>
                    </div>
            @endswitch
        </div>
    </div>
</div>

<!-- Modal Catatan Penolakan -->
<div class="modal fade" id="catatanModalCenter" tabindex="-1" role="dialog" aria-labelledby="catatanModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambahkan Catatan Penolakan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form untuk Menolak Pengajuan -->
                <form id="rejectionForm" action="{{ route('monitoring.keuangan.reject', $pengajuan->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="rejectionNote">Alasan Penolakan</label>
                        <textarea class="form-control" id="rejectionNote" name="rejection_note" rows="5" placeholder="Masukkan alasan penolakan di sini..." required></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger" form="rejectionForm">Reject Pengajuan</button>
            </div>
        </div>
    </div>
</div>
</div>

<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
@endsection
