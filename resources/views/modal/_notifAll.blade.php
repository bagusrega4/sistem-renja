<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">All Notifications</h5>
            </div>
            <div class="modal-body">
                <!-- Notification Item for Pengajuan Selesai -->
                <div class="notification-item d-flex align-items-center mb-3">
                    <div class="notif-icon notif-success me-2">
                        <i class="fa fa-check"></i>
                    </div>
                    <div class="notification-text w-100">
                        <a class="d-flex justify-content-between align-items-center text-decoration-none" data-bs-toggle="collapse" href="#base-selesai" role="button" aria-expanded="false" aria-controls="base-selesai">
                            <div>
                                <strong>Pengajuan Selesai</strong>
                                <p class="mb-0 text-muted">{{ $pengajuanSelesai->count() }} Pengajuan</p>
                            </div>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse mt-2" id="base-selesai">
                            <ul class="list-unstyled ps-3">
                                @foreach($pengajuanSelesai as $fp)
                                <li>
                                    <div class="notif-content clickable" data-bs-toggle="modal" data-bs-target="#viewModalCenter{{ $fp->id }}">
                                        <span class="block fw-bold">{{ $fp->uraian }}</span>
                                        <span class="time text-muted">No. FP: {{ $fp->no_fp }}</span>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Notification Item for Pengajuan Ditolak -->
                <div class="notification-item d-flex align-items-center">
                    <div class="notif-icon notif-danger me-2">
                        <i class="fa fa-times"></i>
                    </div>
                    <div class="notification-text w-100">
                        <a class="d-flex justify-content-between align-items-center text-decoration-none" data-bs-toggle="collapse" href="#base-ditolak" role="button" aria-expanded="false" aria-controls="base-ditolak">
                            <div>
                                <strong>Pengajuan Ditolak</strong>
                                <p class="mb-0 text-muted">{{ $pengajuanDitolak->count() }} Pengajuan</p>
                            </div>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse mt-2" id="base-ditolak">
                            <ul class="list-unstyled ps-3">
                                @foreach($pengajuanDitolak as $fp)
                                <li>
                                    <div class="notif-content clickable" data-bs-toggle="modal" data-bs-target="#viewModalCenter{{ $fp->id }}">
                                        <span class="block fw-bold">{{ $fp->uraian }}</span>
                                        <span class="time text-muted">No. FP: {{ $fp->no_fp }}</span>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('modal-view')
@foreach($formPengajuan as $fp)
<div class="modal fade" id="viewModalCenter{{ $fp->id }}" tabindex="-1" role="dialog" aria-labelledby="viewModalCenterTitle" aria-labelledby="viewModalCenterTitle{{ $fp->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalCenterTitle">View Pengajuan</h5>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="table-monitoring" class="table table-striped" style="width:100%">
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
                                @if($fp->id_status === 5 && (Auth::user()->id_role == 2 || Auth::user()->id_role == 3))
                                <th>Jenis Pembayaran</th>
                                <th>No. SPBy</th>
                                <th>No. DRPP</th>
                                <th>Tanggal DRPP</th>
                                <th>No. SPM</th>
                                <th>Tanggal SPM</th>
                                @endif
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
                            <td class="text-start">
                                {{ \Carbon\Carbon::parse($fp->tanggal_mulai)->translatedFormat('d M Y') }}
                                s.d.
                                {{ \Carbon\Carbon::parse($fp->tanggal_akhir)->translatedFormat('d M Y') }}
                            </td>
                            <td class="text-start">{{$fp -> no_sk}}</td>
                            @if($fp->id_status === 5 && (Auth::user()->id_role == 2 || Auth::user()->id_role == 3))
                            <td class="text-start">{{ $fp -> formKeuangan -> jenis_pembayaran }}</td>
                            <td class="text-start">{{ $fp -> formKeuangan -> no_spby }}</td>
                            <td class="text-start">{{ $fp -> formKeuangan -> no_drpp }}</td>
                            <td class="text-start">{{ $fp -> formKeuangan -> tanggal_drpp }}</td>
                            <td class="text-start">{{ $fp -> formKeuangan -> no_spm }}</td>
                            <td class="text-start">{{ $fp -> formKeuangan -> tanggal_spm }}</td>
                            @endif
                            <td class="text-start nominal-currency">{{ $fp -> nominal }}</td>
                            <td class="text-center">{{ $fp -> rejection_note ?? '-' }}</td>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('exampleModalCenter');

        modal.addEventListener('hidden.bs.modal', function() {
            const openDropdowns = modal.querySelectorAll('.collapse.show');
            openDropdowns.forEach((dropdown) => {
                bootstrap.Collapse.getInstance(dropdown).hide();
            });
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

@section('css')
<style>
    .clickable {
        cursor: pointer;
        transition: color 0.3s ease, text-decoration 0.3s ease;
    }

    .clickable:hover,
    .clickable:focus {
        color: #007bff;
        text-decoration: underline;
    }

    .notification-item a {
        transition: color 0.3s ease, text-decoration 0.3s ease;
    }

    .notification-item a:hover,
    .notification-item a:focus {
        color: #007bff;
        text-decoration: underline;
    }
</style>
@endsection
