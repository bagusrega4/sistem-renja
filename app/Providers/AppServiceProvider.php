<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\FormPengajuan;
use Illuminate\Support\Facades\Log;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer(['_navbar', 'modal._notifAll'], function ($view) {
            Log::info('View Composer executed for modal._notifAll');
            $pengajuanSelesai = FormPengajuan::where('id_status', 5)->get();
            $pengajuanDitolak = FormPengajuan::where('id_status', 3)->get();

            $view->with([
                'pengajuanSelesai' => $pengajuanSelesai,
                'pengajuanDitolak' => $pengajuanDitolak,
            ]);
        });
    }
}
