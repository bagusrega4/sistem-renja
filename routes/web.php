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
use App\Http\Controllers\ManageMAKAkunController;
use App\Http\Controllers\ManageMAKKomponenController;
use App\Http\Controllers\ManageMAKOutputController;
use App\Http\Controllers\ManageMAKSubKomponenController;

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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/check-auth', function () {
    if (Auth::check()) {
        return 'User is authenticated: ' . Auth::user()->name;
    } else {
        return 'User is not authenticated.';
    }
});

Route::resource('form', FormController::class);
// Route::resource('monitoring/keuangan', MonitoringKeuanganController::class);
// Route::resource('monitoring/operator', MonitoringOperatorController::class);
// Route::resource('download', DownloadController::class);
// Route::resource('manage/form', ManageFormController::class);
// Route::resource('manage/user', ManageUserController::class);
// Route::resource('manage/mak/akun', ManageMAKAkunController::class);
// Route::resource('manage/mak/komponen', ManageMAKKomponenController::class);
// Route::resource('manage/mak/output', ManageMAKOutputController::class);
// Route::resource('manage/mak/subkomponen', ManageMAKSubKomponenController::class);
Route::get('/formPengajuan', [FormController::class, 'index'])->name('form.index');
Route::get('/create', [FormController::class, 'create'])->name('form.create');
Route::post('/store', [FormController::class, 'store'])->name('form.store');

require __DIR__ . '/auth.php';
