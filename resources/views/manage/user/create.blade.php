@extends('layouts.app')

@section('content')
<div class="container">
    <div class="page-inner">
        <!-- Notifikasi Error -->
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Notifikasi Sukses -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h2 class="fw-bold mb-3">Tambah User</h2>
                <h6 class="op-7 mb-2">Menambahkan User Baru</h6>
            </div>
            <div class="ms-md-auto py-2 py-md-0">
                <a href="{{ route('manage.user.index') }}" class="btn btn-danger btn-round">Kembali</a>
            </div>
        </div>

        <div class="card card-round">
            <div class="card-body">
                <form action="{{ route('manage.user.store') }}" method="POST">
                    @csrf

                    <!-- Nama -->
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input
                            type="text"
                            name="nama"
                            class="form-control @error('nama') is-invalid @enderror"
                            id="nama"
                            value="{{ old('nama') }}"
                            required>
                        @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- NIP Lama -->
                    <div class="mb-3">
                        <label for="nip_lama" class="form-label">NIP Lama</label>
                        <input
                            type="text"
                            name="nip_lama"
                            class="form-control @error('nip_lama') is-invalid @enderror"
                            id="nip_lama"
                            value="{{ old('nip_lama') }}"
                            required>
                        @error('nip_lama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- NIP Baru -->
                    <div class="mb-3">
                        <label for="nip_baru" class="form-label">NIP Baru</label>
                        <input
                            type="text"
                            name="nip_baru"
                            class="form-control @error('nip_baru') is-invalid @enderror"
                            id="nip_baru"
                            value="{{ old('nip_baru') }}"
                            required>
                        @error('nip_baru')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Jabatan -->
                    <div class="mb-3">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <select
                            name="jabatan"
                            class="form-control @error('jabatan') is-invalid @enderror"
                            id="jabatan"
                            required>
                            <option value="Kepala BPS Provinsi" {{ old('jabatan') == "Kepala BPS Provinsi" ? 'selected' : '' }}>Kepala BPS Provinsi</option>
                            <option value="Statistisi Ahli Madya BPS Provinsi" {{ old('jabatan') == "Statistisi Ahli Madya BPS Provinsi" ? 'selected' : '' }}>Statistisi Ahli Madya BPS Provinsi</option>
                            <option value="Pranata Komputer Ahli Madya BPS Provinsi" {{ old('jabatan') == "Pranata Komputer Ahli Madya BPS Provinsi" ? 'selected' : '' }}>Pranata Komputer Ahli Madya BPS Provinsi</option>
                            <option value="Statistisi Ahli Muda BPS Provinsi" {{ old('jabatan') == "Statistisi Ahli Muda BPS Provinsi" ? 'selected' : '' }}>Statistisi Ahli Muda BPS Provinsi</option>
                            <option value="Analis Anggaran Ahli Muda BPS Provinsi" {{ old('jabatan') == "Analis Anggaran Ahli Muda BPS Provinsi" ? 'selected' : '' }}>Analis Anggaran Ahli Muda BPS Provinsi</option>
                            <option value="Pranata Komputer Ahli Muda BPS Provinsi" {{ old('jabatan') == "Pranata Komputer Ahli Muda BPS Provinsi" ? 'selected' : '' }}>Pranata Komputer Ahli Muda BPS Provinsi</option>
                            <option value="Statistisi Ahli Pertama BPS Provinsi" {{ old('jabatan') == "Statistisi Ahli Pertama BPS Provinsi" ? 'selected' : '' }}>Statistisi Ahli Pertama BPS Provinsi</option>
                            <option value="Statistisi Mahir BPS Provinsi" {{ old('jabatan') == "Statistisi Mahir BPS Provinsi" ? 'selected' : '' }}>Statistisi Mahir BPS Provinsi</option>
                            <option value="Statistisi Penyelia BPS Provinsi" {{ old('jabatan') == "Statistisi Penyelia BPS Provinsi" ? 'selected' : '' }}>Statistisi Penyelia BPS Provinsi</option>
                            <option value="Pranata Komputer Ahli Pertama BPS Provinsi" {{ old('jabatan') == "Pranata Komputer Ahli Pertama BPS Provinsi" ? 'selected' : '' }}>Pranata Komputer Ahli Pertama BPS Provinsi</option>
                            <option value="Staf BPS Provinsi" {{ old('jabatan') == "Staf BPS Provinsi" ? 'selected' : '' }}>Staf BPS Provinsi</option>
                            <option value="Kepala Bagian Umum" {{ old('jabatan') == "Kepala Bagian Umum" ? 'selected' : '' }}>Kepala Bagian Umum</option>
                            <option value="Statistisi Ahli Muda Bagian Umum" {{ old('jabatan') == "Statistisi Ahli Muda Bagian Umum" ? 'selected' : '' }}>Statistisi Ahli Muda Bagian Umum</option>
                            <option value="Pengelola Pengadaan Barang dan Jasa Ahli Muda Bagian Umum" {{ old('jabatan') == "Pengelola Pengadaan Barang dan Jasa Ahli Muda Bagian Umum" ? 'selected' : '' }}>Pengelola Pengadaan Barang dan Jasa Ahli Muda Bagian Umum</option>
                            <option value="Analis Pengelolaan Keuangan APBN Ahli Muda Bagian Umum" {{ old('jabatan') == "Analis Pengelolaan Keuangan APBN Ahli Muda Bagian Umum" ? 'selected' : '' }}>Analis Pengelolaan Keuangan APBN Ahli Muda Bagian Umum</option>
                            <option value="Pranata Komputer Mahir Bagian Umum" {{ old('jabatan') == "Pranata Komputer Mahir Bagian Umum" ? 'selected' : '' }}>Pranata Komputer Mahir Bagian Umum</option>
                            <option value="Arsiparis Ahli Pertama Bagian Umum" {{ old('jabatan') == "Arsiparis Ahli Pertama Bagian Umum" ? 'selected' : '' }}>Arsiparis Ahli Pertama Bagian Umum</option>
                            <option value="Analis SDM Aparatur Ahli Muda Bagian Umum" {{ old('jabatan') == "Analis SDM Aparatur Ahli Muda Bagian Umum" ? 'selected' : '' }}>Analis SDM Aparatur Ahli Muda Bagian Umum</option>
                            <option value="Analis Pengelolaan Keuangan APBN Ahli Pertama Bagian Umum" {{ old('jabatan') == "Analis Pengelolaan Keuangan APBN Ahli Pertama Bagian Umum" ? 'selected' : '' }}>Analis Pengelolaan Keuangan APBN Ahli Pertama Bagian Umum</option>
                            <option value="Analis SDM Aparatur Ahli Pertama Bagian Umum" {{ old('jabatan') == "Analis SDM Aparatur Ahli Pertama Bagian Umum" ? 'selected' : '' }}>Analis SDM Aparatur Ahli Pertama Bagian Umum</option>
                            <option value="Pranata Humas Ahli Pertama Bagian Umum" {{ old('jabatan') == "Pranata Humas Ahli Pertama Bagian Umum" ? 'selected' : '' }}>Pranata Humas Ahli Pertama Bagian Umum</option>
                            <option value="Pengelola Pengadaan Barang dan Jasa Ahli Pertama Bagian Umum" {{ old('jabatan') == "Pengelola Pengadaan Barang dan Jasa Ahli Pertama Bagian Umum" ? 'selected' : '' }}>Pengelola Pengadaan Barang dan Jasa Ahli Pertama Bagian Umum</option>
                            <option value="Statistisi Ahli Pertama Bagian Umum" {{ old('jabatan') == "Statistisi Ahli Pertama Bagian Umum" ? 'selected' : '' }}>Statistisi Ahli Pertama Bagian Umum</option>
                            <option value="Arsiparis Terampil Bagian Umum" {{ old('jabatan') == "Arsiparis Terampil Bagian Umum" ? 'selected' : '' }}>Arsiparis Terampil Bagian Umum</option>
                        </select>
                        @error('jabatan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Golongan -->
                    <div class="mb-3">
                        <label for="golongan" class="form-label">Golongan</label>
                        <select
                            name="golongan"
                            class="form-control @error('golongan') is-invalid @enderror"
                            id="golongan"
                            required>
                            <option value="IV/d" {{ old('golongan') == "IV/d" ? 'selected' : '' }}>IV/d</option>
                            <option value="IV/b" {{ old('golongan') == "IV/b" ? 'selected' : '' }}>IV/b</option>
                            <option value="IV/a" {{ old('golongan') == "IV/a" ? 'selected' : '' }}>IV/a</option>
                            <option value="III/d" {{ old('golongan') == "III/d" ? 'selected' : '' }}>III/d</option>
                            <option value="III/c" {{ old('golongan') == "III/c" ? 'selected' : '' }}>III/c</option>
                            <option value="III/b" {{ old('golongan') == "III/b" ? 'selected' : '' }}>III/b</option>
                            <option value="III/a" {{ old('golongan') == "III/a" ? 'selected' : '' }}>III/a</option>
                            <option value="II/c" {{ old('golongan') == "II/c" ? 'selected' : '' }}>II/c</option>
                            <option value="II/d" {{ old('golongan') == "II/d" ? 'selected' : '' }}>II/d</option>
                            <option value="II/b" {{ old('golongan') == "II/b" ? 'selected' : '' }}>II/b</option>
                        </select>
                        @error('golongan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Username -->
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input
                            type="text"
                            name="username"
                            class="form-control @error('username') is-invalid @enderror"
                            id="username"
                            value="{{ old('username') }}"
                            required
                            autocomplete="off">
                        @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input
                            type="text"
                            name="password"
                            class="form-control @error('password') is-invalid @enderror"
                            id="password"
                            required>
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input
                            type="email"
                            name="email"
                            class="form-control @error('email') is-invalid @enderror"
                            id="email"
                            value="{{ old('email') }}"
                            required>
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Role -->
                    <div class="mb-3">
                        <label for="id_role" class="form-label">Role</label>
                        <select
                            name="id_role"
                            id="id_role"
                            class="form-select @error('id_role') is-invalid @enderror"
                            required>
                            <option value="1" {{ old('id_role') == 1 ? 'selected' : '' }}>Operator</option>
                            <option value="2" {{ old('id_role') == 2 ? 'selected' : '' }}>Keuangan</option>
                            <option value="3" {{ old('id_role') == 3 ? 'selected' : '' }}>Admin</option>
                        </select>
                        @error('id_role')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection