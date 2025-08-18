<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\MonitoringOperatorController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\ManageKegiatanController;
use App\Http\Controllers\KegiatanController;

// -------------------------------------------------------------------
// Halaman Home
// -------------------------------------------------------------------
Route::get('/', function () {
    return view('home');
})->name('home');

// -------------------------------------------------------------------
// Auth & Verifikasi
// -------------------------------------------------------------------
require __DIR__ . '/auth.php';

Route::get('/check-auth', function () {
    if (Auth::check()) {
        return 'User is authenticated: ' . Auth::user()->name;
    } else {
        return 'User is not authenticated.';
    }
})->name('check-auth');

// -------------------------------------------------------------------
// Halaman error jika unauthorized
// -------------------------------------------------------------------
Route::get('/notfound', function () {
    return view('error.unauthorized');
})->name('error.unauthorized');

// -------------------------------------------------------------------
// Lolos 'auth' dan 'verified'
// -------------------------------------------------------------------
Route::middleware(['auth', 'verified'])->group(function () {

    // 1) Route “umum” yang boleh diakses oleh Operator, Keuangan, dan Admin
    Route::middleware('role:1,2,3')->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Profile
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::post('/edit-profile', [ProfileController::class, 'setPhotoProfile'])->name('edit.profile');
        Route::put('/password/change', [ProfileController::class, 'changePassword'])->name('password.change');

        // Form
        Route::name('form.')->prefix('/form')->group(function () {
            Route::get('/', [FormController::class, 'index'])->name('index');
            Route::post('/store', [FormController::class, 'store'])->name('store');
            Route::get('/create', [FormController::class, 'create'])->name('create');
            Route::get('/edit/{id}', [FormController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [FormController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [FormController::class, 'destroy'])->name('delete');
            Route::get('/get-kegiatan/{tim_id}', [FormController::class, 'getKegiatan'])
                ->name('get.kegiatan');
        });

        // Jadwal
        Route::name('jadwal.')->prefix('/jadwal')->group(function () {
            Route::get('/create', [JadwalController::class, 'create'])->name('create');
            Route::post('/store', [JadwalController::class, 'store'])->name('store');
        });

        // Monitoring Operator
        Route::name('monitoring.operator.')->prefix('/monitoring/operator')->group(function () {
            // Menampilkan tabel monitoring
            Route::get('/', [MonitoringOperatorController::class, 'upload'])->name('index');

            // Upload bukti transfer (jika ada)
            Route::get('/upload/{id}', [MonitoringOperatorController::class, 'upload'])->name('upload');
            Route::post('/upload/{id}', [MonitoringOperatorController::class, 'store'])->name('store');

            // Ambil bukti transfer
            Route::get('/get-bukti-transfer/{id}', [MonitoringOperatorController::class, 'getBuktiTransfer'])->name('get.bukti.transfer');

            // Update status diketahui
            Route::put('/update-status/{id}', [MonitoringOperatorController::class, 'updateStatus'])->name('update.status');
        });

        // Manage Kegiatan
        Route::name('manage.kegiatan.')->prefix('manage/kegiatan')->group(function () {
            // List semua kegiatan
            Route::get('/', [KegiatanController::class, 'index'])->name('index');

            // Form tambah kegiatan
            Route::get('/create', [KegiatanController::class, 'create'])->name('create');

            // Simpan kegiatan baru
            Route::post('/store', [KegiatanController::class, 'store'])->name('store');

            // Tandai kegiatan selesai
            Route::patch('/{id}/selesai', [KegiatanController::class, 'selesai'])->name('selesai');

            // (opsional) update kegiatan kalau ada fitur edit
            Route::put('/{id}', [KegiatanController::class, 'update'])->name('update');

            // (opsional) hapus kegiatan
            Route::delete('/{id}', [KegiatanController::class, 'destroy'])->name('destroy');
        });
    });
});
