<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FormController;
use App\Http\Controllers\MonitoringKeuanganController;
use App\Http\Controllers\MonitoringOperatorController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\ManageFormController;
use App\Http\Controllers\ManageUserController;
use App\Http\Controllers\ManageMAKController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'role:user'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/edit-profile', [ProfileController::class, 'setPhotoProfile'])->name('edit.profile');

Route::get('/check-auth', function () {
    if (Auth::check()) {
        return 'User is authenticated: ' . Auth::user()->name;
    } else {
        return 'User is not authenticated.';
    }
});

// Route::resource('form', FormController::class);
// Route::resource('monitoring/keuangan', MonitoringKeuanganController::class);
// Route::resource('monitoring/operator', MonitoringOperatorController::class);
Route::resource('download', DownloadController::class);
// Route::resource('manage/form', ManageFormController::class);
Route::resource('manage/user', ManageUserController::class)->except(['show']);

// Manage
Route::name('manage.')->prefix('/manage')->group(function () {

    // Mata Anggaran Keuangan
    Route::name('mak.')->prefix('/mak')->group(function () {

        // Manage MAK Akun
        Route::get('/akun', [ManageMAKController::class, 'akun'])->name('akun');
        Route::get('/akun/create', [ManageMAKController::class, 'createAkun'])->name('akun.create');
        Route::post('/akun/store', [ManageMAKController::class, 'storeAkun'])->name('akun.store');
        Route::put('/akun/{id}/update-flag', [ManageMAKController::class, 'updateFlagAkun'])->name('akun.updateFlag');

        // Manage MAK Komponen
        Route::get('/komponen', [ManageMAKController::class, 'komponen'])->name('komponen');
        Route::get('/komponen/create', [ManageMAKController::class, 'createKomponen'])->name('komponen.create');
        Route::post('/komponen/store', [ManageMAKController::class, 'storeKomponen'])->name('komponen.store');
        Route::put('/komponen/{id}/update-flag', [ManageMAKController::class, 'updateFlagKomponen'])->name('komponen.updateFlag');

        // Manage MAK Subkomponen
        Route::get('/subkomponen', [ManageMAKController::class, 'subkomponen'])->name('subkomponen');
        Route::get('/subkomponen/create', [ManageMAKController::class, 'createSubKomponen'])->name('subkomponen.create');
        Route::post('/subkomponen/store', [ManageMAKController::class, 'storeSubKomponen'])->name('subkomponen.store');
        Route::put('/subkomponen/{id}/update-flag', [ManageMAKController::class, 'updateFlagSubKomponen'])->name('subkomponen.updateFlag');

        // Manage MAK Output
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
    });

    // Manage Form
    Route::name('form.')->prefix('/form')->group(function () {
        Route::get('/', [ManageFormController::class, 'index'])->name('index');
    });
});

// Form Pengajuan
Route::name('form.')->prefix('/form')->group(function () {
    Route::get('/', [FormController::class, 'index'])->name('index');
    Route::get('/create', [FormController::class, 'create'])->name('create');
    Route::post('/store', [FormController::class, 'store'])->name('store');
    Route::get('/edit/{no_fp}', [FormController::class, 'edit'])->name('edit');
    Route::put('/update/{no_fp}', [FormController::class, 'update'])->name('update');
    Route::delete('/delete/{no_fp}', [FormController::class, 'destroy'])->name('delete');
});

// Download 
Route::prefix('download')->name('download.')->group(function () {
    Route::get('/', [DownloadController::class, 'index'])->name('index');
    Route::post('/proses', [DownloadController::class, 'download'])->name('proses');
});

// Monitoring
Route::name('monitoring.')->prefix('/monitoring')->group(function () {

    // Operator
    Route::name('operator.')->prefix('/operator')->group(function () {
        Route::get('/', [MonitoringOperatorController::class, 'index'])->name('index');
        Route::get('/upload/{no_fp}', [MonitoringOperatorController::class, 'upload'])->name('upload');
        Route::post('/store-file', [MonitoringOperatorController::class, 'store'])->name('storeFile');
    });

    // Keuangan
    Route::name('keuangan.')->prefix('/keuangan')->group(function () {
        Route::get('/', [MonitoringKeuanganController::class, 'index'])->name('index');
        Route::get('/file/{id}', [MonitoringKeuanganController::class, 'viewFile'])->name('file');
        Route::get('/upload/{no_fp}', [MonitoringKeuanganController::class, 'upload'])->name('upload');
        Route::post('/store-file', [MonitoringKeuanganController::class, 'store'])->name('storeFile');
        Route::post('/accept-file', [MonitoringKeuanganController::class, 'accept'])->name('accept');
        Route::post('/reject-file', [MonitoringKeuanganController::class, 'reject'])->name('reject');
    });
});

Route::get('/notfound', function () {
    return view('error.unauthorized');
})->name('error.unauthorized');
require __DIR__ . '/auth.php';
