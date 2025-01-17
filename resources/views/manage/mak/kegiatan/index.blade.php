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
                <h2 class="fw-bold mb-3">Kelola Mata Anggaran Keuangan</h2>
                <h6 class="op-7 mb-2">Pengelolaan Mata Anggaran Keuangan Kegiatan Sistem Bukti Dukung Administrasi BPS Provinsi DKI Jakarta</h6>
            </div>
            <div class="ms-md-auto py-2 py-md-0">
                <a href="{{ route('manage.mak.kegiatan.create') }}" class="btn btn-primary btn-round">Tambah Kegiatan</a>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card card-round">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                        <div class="card-title">Daftar Kegiatan</div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <!-- Tabel Kegiatan -->
                        <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kode</th>
                                    <th>Nama Kegiatan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kegiatans as $kegiatan)
                                <tr>
                                    <th scope="row">
                                        {{ $loop->iteration }}
                                    </th>
                                    <td class="text-end">{{ $kegiatan->kode }}</td>
                                    <td class="text-start">{{ $kegiatan->kegiatan }}</td>
                                    <td>
                                        <div class="btn-group dropdown">
                                            <button
                                                class="btn {{ $kegiatan->flag == 1 ? 'btn-outline-success' : 'btn-outline-danger' }} dropdown-toggle"
                                                type="button"
                                                data-bs-toggle="dropdown"
                                                data-id="{{ $kegiatan->id }}"
                                                data-flag="{{ $kegiatan->flag }}"
                                                data-kegiatan="{{ $kegiatan->kegiatan }}">
                                                {{ $kegiatan->flag == 1 ? 'Tampilkan' : 'Jangan Tampilkan' }}
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li>
                                                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#confirmModal" data-id="{{ $kegiatan->id }}" data-flag="1" data-kegiatan="{{ $kegiatan->kegiatan }}">Tampilkan</button>
                                                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#confirmModal" data-id="{{ $kegiatan->id }}" data-flag="0" data-kegiatan="{{ $kegiatan->kegiatan }}">Jangan Ditampilkan</button>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Tabel Kegiatan -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Ubah Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin <b><span id="modal-action-text"></span></b> kegiatan <b><span id="modal-kegiatan"></span></b>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                <form id="modalForm" method="POST" style="display: inline;">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="flag" id="modal-flag">
                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const confirmModal = document.getElementById('confirmModal');
        const modalForm = confirmModal.querySelector('#modalForm');
        const modalActionText = confirmModal.querySelector('#modal-action-text');
        const modalKegiatan = confirmModal.querySelector('#modal-kegiatan');
        const modalFlag = confirmModal.querySelector('#modal-flag');

        const updateFlagRoutePattern = "{{ route('manage.mak.kegiatan.updateFlag', ':id') }}";

        confirmModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const flag = button.getAttribute('data-flag');
            const kegiatan = button.getAttribute('data-kegiatan');

            const actionText = flag == "1" ? "menampilkan" : "tidak menampilkan";

            modalActionText.textContent = actionText;
            modalFlag.value = flag;
            modalKegiatan.textContent = kegiatan;
            modalForm.action = updateFlagRoutePattern.replace(':id', id);
        });
    });
</script>
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