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
})->middleware(['auth', 'verified'])->name('dashboard');

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

Route::resource('form', FormController::class);
Route::resource('monitoring/keuangan', MonitoringKeuanganController::class);
Route::get('monitoring/keuangan/file', [MonitoringKeuanganController::class, 'viewFile'])->name('monitoring.file.keuangan');

Route::resource('monitoring/operator', MonitoringOperatorController::class);
Route::resource('download', DownloadController::class);
Route::resource('manage/form', ManageFormController::class);
Route::resource('manage/user', ManageUserController::class)->except(['show']);

Route::name('manage.')->prefix('/manage')->group(function () {
    Route::name('mak.')->prefix('/mak')->group(function () {
        Route::get('/akun', [ManageMAKController::class, 'akun'])->name('akun');
        Route::get('/akun/create', [ManageMAKController::class, 'createAkun'])->name('akun.create');
        Route::post('/akun/store', [ManageMAKController::class, 'storeAkun'])->name('akun.store');
        Route::put('/akun/{id}/update-flag', [ManageMAKController::class, 'updateFlagAkun'])->name('akun.updateFlag');

        Route::get('/komponen', [ManageMAKController::class, 'komponen'])->name('komponen');
        Route::get('/komponen/create', [ManageMAKController::class, 'createKomponen'])->name('komponen.create');
        Route::post('/komponen/store', [ManageMAKController::class, 'storeKomponen'])->name('komponen.store');
        Route::put('/komponen/{id}/update-flag', [ManageMAKController::class, 'updateFlagKomponen'])->name('komponen.updateFlag');

        Route::get('/subkomponen', [ManageMAKController::class, 'subkomponen'])->name('subkomponen');
        Route::get('/subkomponen/create', [ManageMAKController::class, 'createSubKomponen'])->name('subkomponen.create');
        Route::post('/subkomponen/store', [ManageMAKController::class, 'storeSubKomponen'])->name('subkomponen.store');
        Route::put('/subkomponen/{id}/update-flag', [ManageMAKController::class, 'updateFlagSubKomponen'])->name('subkomponen.updateFlag');

        Route::get('/output', [ManageMAKController::class, 'output'])->name('output');
        Route::get('/output/create', [ManageMAKController::class, 'createOutput'])->name('output.create');
        Route::post('/output/store', [ManageMAKController::class, 'storeOutput'])->name('output.store');
        Route::put('/output/{id}/update-flag', [ManageMAKController::class, 'updateFlagOutput'])->name('output.updateFlag');
    });
    Route::name('user.')->prefix('/user')->group(function () {
        Route::get('/index', [ManageUserController::class, 'index'])->name('index');
        Route::get('/create', [ManageUserController::class, 'create'])->name('create');
        Route::post('/store', [ManageUserController::class, 'store'])->name('store');
        Route::put('/{id}/update-role', [ManageUserController::class, 'updateRoleUser'])->name('updateRole');
    });
});

Route::get('/formPengajuan', [FormController::class, 'index'])->name('form.index');
Route::get('/create', [FormController::class, 'create'])->name('form.create');
Route::post('/store', [FormController::class, 'store'])->name('form.store');

Route::get('/form/edit/{no_fp}', [FormController::class, 'edit'])->name('form.edit');
Route::put('/form/update/{no_fp}', [FormController::class, 'update'])->name('form.update');

Route::get('monitoring/operator', [MonitoringOperatorController::class, 'index'])->name('monitoring.operator');
require __DIR__ . '/auth.php';
