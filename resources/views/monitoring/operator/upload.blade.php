@extends('layouts/app')

@section('content')
<div class="container">
    <div class="page-inner">

        {{-- Notifikasi Error Custom --}}
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert-message">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        {{-- Notifikasi Validasi Error --}}
        @if ($errors->any())
        <div class="alert alert-danger" id="alert-message">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- Notifikasi Sukses Bootstrap --}}
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert-message">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        {{-- Notifikasi Sukses SweetAlert --}}
        @if(session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: @json(session('success')),
                showConfirmButton: false,
                timer: 2000
            });
        </script>
        @endif

        @if(in_array(auth()->user()->id_role, [2,3]))
        <div class="mb-3">
            <form method="GET" action="{{ route('monitoring.operator.index') }}">
                <div class="row g-3">
                    {{-- Filter Tim: hanya untuk Admin --}}
                    @if(auth()->user()->id_role == 3)
                    <div class="col">
                        <label for="tim_id" class="form-label fw-bold">Pilih Tim Kerja</label>
                        <select name="tim_id" id="tim_id" class="form-select">
                            <option value="" disabled {{ request('tim_id') ? '' : 'selected' }}>Pilih Tim</option>
                            @foreach($timList as $tim)
                            <option value="{{ $tim->id }}" {{ request('tim_id') == $tim->id ? 'selected' : '' }}>
                                {{ $tim->nama_tim }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    @endif

                    {{-- Filter Nama --}}
                    <div class="col">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" name="nama" id="nama" value="{{ request('nama') }}" class="form-control" placeholder="Cari nama...">
                    </div>

                    {{-- Filter Kegiatan --}}
                    <div class="col">
                        <label for="kegiatan" class="form-label">Kegiatan</label>
                        <input type="text" name="kegiatan" id="kegiatan" value="{{ request('kegiatan') }}" class="form-control" placeholder="Cari kegiatan...">
                    </div>

                    {{-- Filter Periode Mulai --}}
                    <div class="col">
                        <label for="periode_mulai" class="form-label">Periode Mulai</label>
                        <input type="date" name="periode_mulai" id="periode_mulai" value="{{ request('periode_mulai') }}" class="form-control">
                    </div>

                    {{-- Filter Periode Selesai --}}
                    <div class="col">
                        <label for="periode_selesai" class="form-label">Periode Selesai</label>
                        <input type="date" name="periode_selesai" id="periode_selesai" value="{{ request('periode_selesai') }}" class="form-control">
                    </div>

                    {{-- Tombol --}}
                    <div class="col-auto d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2">Filter</button>
                        <a href="{{ route('monitoring.operator.index') }}" class="btn btn-secondary">Reset</a>
                    </div>
                </div>
            </form>
        </div>
        @endif

        {{-- Tabel Monitoring Rencana Kerja --}}
        <div class="card card-round">
            <div class="card-header">
                <h4 class="card-title">Monitoring Rencana Kerja</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Tim Kerja</th>
                            <th>Kegiatan</th>
                            <th>Periode Kegiatan</th>
                            <th>Tanggal Keluar</th>
                            <th>Pukul</th>
                            <th>Diketahui Ketua</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rencanaKerja as $index => $rk)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $rk->user->pegawai->nama ?? '-' }}</td>
                            <td>{{ $rk->tim->nama_tim ?? '-' }}</td>
                            <td>{{ $rk->managekegiatan->nama_kegiatan ?? '-' }}</td>
                            <td>
                                @if($rk->managekegiatan && $rk->managekegiatan->periode_mulai && $rk->managekegiatan->periode_selesai)
                                {{ \Carbon\Carbon::parse($rk->managekegiatan->periode_mulai)->translatedFormat('j F Y') }}
                                -
                                {{ \Carbon\Carbon::parse($rk->managekegiatan->periode_selesai)->translatedFormat('j F Y') }}
                                @else
                                -
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($rk->tanggal)->translatedFormat('j F Y') }}</td>
                            <td>
                                @php
                                $pukul = ($rk->jam_mulai && $rk->jam_akhir)
                                ? \Carbon\Carbon::parse($rk->jam_mulai)->format('H:i') . ' - ' . \Carbon\Carbon::parse($rk->jam_akhir)->format('H:i')
                                : '-';
                                @endphp
                                {{ $pukul }}
                            </td>
                            <td class="text-center">
                                @if(auth()->user()->id_role == 2)
                                <form action="{{ route('monitoring.operator.update.status', $rk->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="diketahui" value="0">
                                    <input type="checkbox"
                                        name="diketahui"
                                        value="1"
                                        {{ $rk->diketahui ? 'checked' : '' }}
                                        onchange="this.form.submit()"
                                        style="transform: scale(1.5); accent-color: green; cursor: pointer;">
                                </form>
                                @else
                                <input type="checkbox"
                                    {{ $rk->diketahui ? 'checked' : '' }}
                                    onclick="return false;"
                                    style="transform: scale(1.5); accent-color: green; cursor: not-allowed;">
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">Belum ada rencana kerja.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

{{-- Script tambahan --}}
<script>
    // Auto-hide alert bootstrap setelah 10 detik
    setTimeout(function() {
        var alert = document.getElementById('alert-message');
        if (alert) {
            var bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }
    }, 10000);
</script>
@endsection