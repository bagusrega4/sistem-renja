@extends('layouts/app')
@section('content')
<div class="container">
    <div class="page-inner">
        <div
            class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h2 class="fw-bold mb-3">Kelola Mata Anggaran Keuangan</h2>
                <h6 class="op-7 mb-2">Mengelola Mata Anggaran Keuangan tabel Akun Belanja</h6>
            </div>
            <div class="ms-md-auto py-2 py-md-0">
                <a href="{{ route('manage.mak.akun.create') }}" class="btn btn-primary btn-round">Tambah Akun Belanja</a>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card card-round">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                        <div class="card-title">Tabel Akun Belanja</div>
                        <div class="card-tools">
                            <div class="dropdown">
                                <button
                                    class="btn btn-icon btn-clean me-0"
                                    type="button"
                                    id="dropdownMenuButton"
                                    data-bs-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false">
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
                                    <th>Kode</th>
                                    <th>Nama Akun</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($accounts as $account)
                                    <tr>
                                        <th scope="row">
                                            {{ $loop->iteration }}
                                        </th>
                                        <td class="text-start">{{ $account->kode }}</td>
                                        <td class="text-start">{{ $account->akun_belanja }}</td>
                                        <td>
                                            <!-- Aksi Column -->
                                            <div class="btn-group dropdown">
                                                <button
                                                    class="btn btn-warning dropdown-toggle"
                                                    type="button"
                                                    data-bs-toggle="dropdown">
                                                    {{ $account->flag == 1 ? 'Tampilkan' : 'Jangan Tampilkan' }}
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li>
                                                        <a class="dropdown-item" href="#">Tampilkan</a>
                                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#changeFlagModalCenter{{ $loop->iteration }}" href="#">Jangan Ditampilkan</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Modal Ubah Flag -->
                                    <div class="modal fade" id="changeFlagModalCenter{{ $loop->iteration }}" tabindex="-1" aria-labelledby="changeFlagModalCenterLabel{{ $loop->iteration }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="changeFlagModalCenterLabel{{ $loop->iteration }}">Ubah Flag</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Konten Modal: Konfirmasi Ubah Flag -->
                                                    Apakah Anda yakin ingin mengubah flag untuk akun "{{ $account->akun_belanja }}"?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <form action="{{ route('manage.mak.akun.updateFlag', $account->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
