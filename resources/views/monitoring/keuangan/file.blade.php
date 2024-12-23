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
                      <a href="{{ optional($fileOperator)->kak_ttd ? asset('/storage/' . $fileOperator->kak_ttd) : '#' }}" target="_blank" class="btn btn-success btn-sm me-2">
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
                      <a href="{{ optional($fileOperator)->surat_tugas ?asset($fileOperator->surat_tugas)  : '#'}}" target="_blank" class="btn btn-success btn-sm me-2">
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
                      <a href="{{ optional($fileOperator)->sk_kpa ?asset($fileOperator->	sk_kpa)  : '#'}}" target="_blank" class="btn btn-success btn-sm me-2">
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
                      <a href="{{ optional($fileOperator)->laporan_innas ?asset($fileOperator->laporan_innas) : '#' }}" target="_blank" class="btn btn-success btn-sm me-2">
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
                      <a href="{{ optional($fileOperator)->daftar_hadir ?asset($fileOperator->daftar_hadir)  : '#'}}" target="_blank" class="btn btn-success btn-sm me-2">
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
                      <a href="{{ optional($fileOperator)->absen_harian ?asset($fileOperator->absen_harian) : '#' }}" target="_blank" class="btn btn-success btn-sm me-2">
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
                      <a href="{{ optional($fileOperator)->rekap_norek_innas ?asset($fileOperator->rekap_norek_innas) : '#' }}" target="_blank" class="btn btn-success btn-sm me-2">
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

      <div class="modal fade" id="catatanModalCenter" tabindex="-1" role="dialog" aria-labelledby="catatanModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
            <!-- Header Modal -->
            <div class="modal-header">
              <h5 class="modal-title" id="catatanModalCenterTitle">Tambahkan Catatan Penolakan</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="rejectionForm" method="POST" action="{{route('monitoring.keuangan.reject')}}">
              <!-- Body Modal -->
              <div class="modal-body">
                @csrf
                <div class="form-group mb-3">
                  <label for="rejectionNote" class="form-label">Alasan Penolakan</label>
                  <textarea class="form-control" id="catatan" name="catatan" rows="5" placeholder="Masukkan alasan penolakan di sini..." required></textarea>
                </div>
              </div>

              <!-- Footer Modal -->
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" onclick="saveRejectionNote()">Simpan</button>
              </div>
            </form>
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
</div>

@endsection