<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\MonitoringKeuanganController;
use App\Http\Controllers\MonitoringOperatorController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\ManageFormController;
use App\Http\Controllers\ManageUserController;
use App\Http\Controllers\ManageMAKController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PanduanController;

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

Route::get('/short', [MonitoringKeuanganController::class, 'index'])->name('short');
Route::get('/short2', [MonitoringOperatorController::class, 'index'])->name('short2');
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

        // Notification
        Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');

        // Form Pengajuan
        Route::name('form.')->prefix('/form')->group(function () {
            Route::get('/', [FormController::class, 'index'])->name('index');
            Route::post('/store', [FormController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [FormController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [FormController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [FormController::class, 'destroy'])->name('delete');
        });

        // Monitoring Operator
        Route::name('monitoring.operator.')->prefix('/monitoring/operator')->group(function () {
            Route::get('/', [MonitoringOperatorController::class, 'index'])->name('index');
            Route::get('/upload/{id}', [MonitoringOperatorController::class, 'upload'])->name('upload');
            Route::post('/upload/{id}', [MonitoringOperatorController::class, 'store'])->name('store');
            Route::get('/get-bukti-transfer/{id}', [MonitoringOperatorController::class, 'getBuktiTransfer'])->name('get.bukti.transfer');
        });

        // Download
        Route::prefix('download')->name('download.')->group(function () {
            Route::get('/', [DownloadController::class, 'index'])->name('index');
            Route::post('/proses', [DownloadController::class, 'download'])->name('proses');
        });

        // Panduan
        Route::prefix('panduan')->name('panduan.')->group(function () {
            Route::get('/', [PanduanController::class, 'index'])->name('index');
            Route::get('/upload', [PanduanController::class, 'uploadPanduan'])->name('upload.form');
            Route::post('/upload', [PanduanController::class, 'storePanduan'])->name('upload');
        });
    });

    // 2) Route khusus untuk Keuangan (role=2) dan Admin (role=3)
    Route::middleware('role:2,3')->group(function () {
        // Monitoring Keuangan
        Route::name('monitoring.keuangan.')->prefix('/monitoring/keuangan')->group(function () {
            Route::get('/', [MonitoringKeuanganController::class, 'index'])->name('index');
            Route::get('/file/{id}', [MonitoringKeuanganController::class, 'viewFile'])->name('file');
            Route::get('/upload/{id}', [MonitoringKeuanganController::class, 'upload'])->name('upload');
            Route::post('/upload/{id}', [MonitoringKeuanganController::class, 'store'])->name('store');
            Route::post('/approve/{id}', [MonitoringKeuanganController::class, 'approve'])->name('approve');
            Route::post('/reject/{id}', [MonitoringKeuanganController::class, 'reject'])->name('reject');
            Route::get('/get-bukti-transfer/{id}', [MonitoringKeuanganController::class, 'getBuktiTransfer'])->name('get.bukti.transfer');
        });
    });

    // 3) Route khusus Admin (role=3) – fitur Manage
    Route::middleware('role:3')->group(function () {

        // Manage (prefix: /manage)
        Route::name('manage.')->prefix('/manage')->group(function () {

            // Manage MAK (Mata Anggaran Keuangan)
            Route::name('mak.')->prefix('/mak')->group(function () {

                // Akun
                Route::get('/akun', [ManageMAKController::class, 'akun'])->name('akun');
                Route::get('/akun/create', [ManageMAKController::class, 'createAkun'])->name('akun.create');
                Route::post('/akun/store', [ManageMAKController::class, 'storeAkun'])->name('akun.store');
                Route::put('/akun/{id}/update-flag', [ManageMAKController::class, 'updateFlagAkun'])->name('akun.updateFlag');

                // Komponen
                Route::get('/komponen', [ManageMAKController::class, 'komponen'])->name('komponen');
                Route::get('/komponen/create', [ManageMAKController::class, 'createKomponen'])->name('komponen.create');
                Route::post('/komponen/store', [ManageMAKController::class, 'storeKomponen'])->name('komponen.store');
                Route::put('/komponen/{id}/update-flag', [ManageMAKController::class, 'updateFlagKomponen'])->name('komponen.updateFlag');

                // Subkomponen
                Route::get('/subkomponen', [ManageMAKController::class, 'subkomponen'])->name('subkomponen');
                Route::get('/subkomponen/create', [ManageMAKController::class, 'createSubKomponen'])->name('subkomponen.create');
                Route::post('/subkomponen/store', [ManageMAKController::class, 'storeSubKomponen'])->name('subkomponen.store');
                Route::put('/subkomponen/{id}/update-flag', [ManageMAKController::class, 'updateFlagSubKomponen'])->name('subkomponen.updateFlag');

                // Kegiatan
                Route::get('/kegiatan', [ManageMAKController::class, 'kegiatan'])->name('kegiatan');
                Route::get('/kegiatan/create', [ManageMAKController::class, 'createKegiatan'])->name('kegiatan.create');
                Route::post('/kegiatan/store', [ManageMAKController::class, 'storeKegiatan'])->name('kegiatan.store');
                Route::put('/kegiatan/{id}/update-flag', [ManageMAKController::class, 'updateFlagKegiatan'])->name('kegiatan.updateFlag');

                // KRO
                Route::get('/kro', [ManageMAKController::class, 'kro'])->name('kro');
                Route::get('/kro/create', [ManageMAKController::class, 'createKro'])->name('kro.create');
                Route::post('/kro/store', [ManageMAKController::class, 'storeKro'])->name('kro.store');
                Route::put('/kro/{id}/update-flag', [ManageMAKController::class, 'updateFlagKro'])->name('kro.updateFlag');

                // Output
                Route::get('/output', [ManageMAKController::class, 'output'])->name('output');
                Route::get('/output/create', [ManageMAKController::class, 'createOutput'])->name('output.create');
                Route::post('/output/store', [ManageMAKController::class, 'storeOutput'])->name('output.store');
                Route::put('/output/{id}/update-flag', [ManageMAKController::class, 'updateFlagOutput'])->name('output.updateFlag');
            });

            // Manage User
            Route::name('user.')->prefix('/user')->group(function () {
                Route::get('/', [ManageUserController::class, 'index'])->name('index');
                Route::get('/create', [ManageUserController::class, 'create'])->name('create');
                Route::post('/store', [ManageUserController::class, 'store'])->name('store');
                Route::put('/{id}/update-role', [ManageUserController::class, 'updateRoleUser'])->name('updateRole');
                Route::get('/edit/{id}', [ManageUserController::class, 'edit'])->name('edit');
                Route::put('/{id}', [ManageUserController::class, 'update'])->name('update');
                Route::delete('/{id}', [ManageUserController::class, 'destroy'])->name('destroy');
            });
        });
    });
});
