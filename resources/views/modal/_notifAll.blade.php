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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('exampleModalCenter');

        modal.addEventListener('hidden.bs.modal', function () {
            const openDropdowns = modal.querySelectorAll('.collapse.show');
            openDropdowns.forEach((dropdown) => {
                bootstrap.Collapse.getInstance(dropdown).hide();
            });
        });
    });
</script>

{{-- <!-- Modal View -->
@section('modal-view')
@section('modal-view')
@foreach($pengajuanSelesai->concat($pengajuanDitolak) as $fp)
<div class="modal fade" id="viewModalCenter{{ $fp->id }}" tabindex="-1" role="dialog" aria-labelledby="viewModalCenterTitle{{ $fp->id }}" aria-hidden="true">
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
                <th>Rincian Output</th>
                <th>Komponen</th>
                <th>Sub Komponen</th>
                <th>Akun</th>
                <th>No. FP</th>
                <th>Tanggal Kegiatan</th>
                <th>Nama Permintaan</th>
                <th>No. SK</th>
                <th>Nominal</th>
                <th>Catatan</th>
                <th>Bukti Transfer</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-start">[{{ $fp->output->kegiatan->kode }}.{{ $fp->output->kro->kode }}.{{ $fp->output->kode_ro }}] {{ $fp->output->output }}</td>
                <td class="text-start">{{ $fp->komponen->komponen }}</td>
                <td class="text-start">{{ $fp->subKomponen->sub_komponen }}</td>
                <td class="text-start">{{ $fp->akunBelanja->nama_akun }}</td>
                <td class="text-start">{{ $fp->no_fp }}</td>
                <td class="text-start">{{ $fp->tanggal_mulai }} s.d. {{ $fp->tanggal_akhir }}</td>
                <td class="text-start">{{ $fp->uraian }}</td>
                <td class="text-start">{{ $fp->no_sk }}</td>
                <td class="text-start nominal-currency">{{ $fp->nominal }}</td>
                <td class="text-center">{{ $fp->rejection_note ?? '-' }}</td>
                <td class="text-end">
                  <button type="button" class="btn btn-primary btn-sm me-2" data-bs-toggle="modal" data-bs-target="#previewModal" title="Preview Bukti Pengajuan">
                    <i class="fas fa-eye"></i>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endforeach
@endsection --}}

@section('css')
<style>
    .clickable {
        cursor: pointer;
        transition: color 0.3s ease, text-decoration 0.3s ease;
    }

    .clickable:hover, .clickable:focus {
        color: #007bff;
        text-decoration: underline;
    }

    .notification-item a {
        transition: color 0.3s ease, text-decoration 0.3s ease;
    }

    .notification-item a:hover, .notification-item a:focus {
        color: #007bff;
        text-decoration: underline;
    }
</style>
@endsection


