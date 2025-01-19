<?php 

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\View;
use App\Models\FormPengajuan;

class NotificationMiddleware
{
    public function handle($request, Closure $next)
    {
        $unreadNotifCount = FormPengajuan::whereIn('id_status', [5, 3])
            ->where('is_opened', false)
            ->count();
        View::share('unreadNotifCount', $unreadNotifCount);

        $unreadPengajuan = FormPengajuan::whereIn('id_status', [5, 3])
            ->where('is_opened', false)
            ->get();
        View::share('unreadPengajuan', $unreadPengajuan);

        return $next($request);
    }
}
