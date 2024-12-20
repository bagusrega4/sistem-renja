@extends('layouts/app')
@section('content')
<div class="container">
  <div class="page-inner">
    <div
      class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
      <div>
        <a href="{{ route('monitoring.keuangan.index') }}" class="btn btn-dark mb-4">
          <i class="fas fa-arrow-left"></i> Back
        </a>
        <h3 class="fw-bold mb-3">Monitoring File</h3>
        <h6 class="op-7 mb-2">Monitoring pada berkas yang telah di upload operator dan beri pesetujuan untuk pengajuan</h6>
      </div>
    </div>
    <!-- Tabel Monitoring-->
    <div class="col-md-12">
      <div class="card card-round">
        <div class="card-header">
          <div class="card-head-row card-tools-still-right">
            <div class="card-title">Supervisi Survei Ekonomi Nasional</div>

          </div>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <!-- Projects table -->
            <table id="example" class="table table-striped" style="width:100%">

              <tbody>
                <tr>
                  <th scope="row">1</th>
                  <td>KAK TTD</td>
                  <td>
                    <div class="d-flex justify-content-end">
                      <a href="{{ asset('/storage/'.$fileOperator->kak_ttd) }}" target="_blank" class="btn btn-success btn-sm me-2">
                        <i class="fas fa-eye"></i>
                      </a>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">2</th>
                  <td>Surat Tugas</td>
                  <td>
                    <div class="d-flex justify-content-end">
                      <a href="{{ asset($fileOperator->surat_tugas) }}" target="_blank" class="btn btn-success btn-sm me-2">
                        <i class="fas fa-eye"></i>
                      </a>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">3</th>
                  <td>SK KPA</td>
                  <td>
                    <div class="d-flex justify-content-end">
                      <a href="{{ asset($fileOperator->	sk_kpa) }}" target="_blank" class="btn btn-success btn-sm me-2">
                        <i class="fas fa-eye"></i>
                      </a>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">4</th>
                  <td>Laporan Innas</td>
                  <td>
                    <div class="d-flex justify-content-end">
                      <a href="{{ asset($fileOperator->laporan_innas) }}" target="_blank" class="btn btn-success btn-sm me-2">
                        <i class="fas fa-eye"></i>
                      </a>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">5</th>
                  <td>Daftar Hadir</td>
                  <td>
                    <div class="d-flex justify-content-end">
                      <a href="{{ asset($fileOperator->daftar_hadir) }}" target="_blank" class="btn btn-success btn-sm me-2">
                        <i class="fas fa-eye"></i>
                      </a>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">6</th>
                  <td>Absen Harian</td>
                  <td>
                    <div class="d-flex justify-content-end">
                      <a href="{{ asset($fileOperator->absen_harian) }}" target="_blank" class="btn btn-success btn-sm me-2">
                        <i class="fas fa-eye"></i>
                      </a>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">7</th>
                  <td>Rekap Norek Innas</td>
                  <td>
                    <div class="d-flex justify-content-end">
                      <a href="{{ asset($fileOperator->rekap_norek_innas) }}" target="_blank" class="btn btn-success btn-sm me-2">
                        <i class="fas fa-eye"></i>
                      </a>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="ms-md-auto py-2 py-md-0 text-end">
        <a href="#" class="btn btn-success btn-round">
          <i class="fas fa-check"></i> Approve Pengajuan
        </a>
        <a href="#" class="btn btn-danger btn-round" data-bs-toggle="modal" data-bs-target="#catatanModalCenter">
          <i class="fas fa-times"></i> Reject Pengajuan
        </a>
      </div>
    </div>
  </div>

  <!-- Modal Catatan Penolakan -->
  <div class="modal fade" id="catatanModalCenter" tabindex="-1" role="dialog" aria-labelledby="catatanModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="catatanModalCenterTitle">Tambahkan Catatan Penolakan</h5>
        </div>
        <div class="modal-body">
          <form id="rejectionForm">
            <div class="form-group">
              <label for="rejectionNote">Alasan Penolakan</label>
              <textarea class="form-control" id="rejectionNote" rows="5" placeholder="Masukkan alasan penolakan di sini..."></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" id="batal">Batal</button>
          <button type="button" class="btn btn-primary" onclick="saveRejectionNote()">Simpan</button>
        </div>
      </div>
    </div>
    <div class="ms-md-auto py-2 py-md-0 text-end">
      <a href="#" class="btn btn-success btn-round">
        <i class="fas fa-check"></i> Approve Pengajuan
      </a>
      <a href="#" class="btn btn-danger btn-round">
        <i class="fas fa-times"></i> Reject Pengajuan
      </a>
    </div>
  </div>
</div>

@endsection