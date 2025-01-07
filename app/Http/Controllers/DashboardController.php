<?php

namespace App\Http\Controllers;

use App\Models\FormPengajuan;
use App\Enums\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'totalPengajuan' => FormPengajuan::count(),
            'entriOperator' => FormPengajuan::where('id_status', 1)->count(),
            'pengecekanDokumen' => FormPengajuan::where('id_status', 2)->count(),
            'ditolak' => FormPengajuan::where('id_status', 3)->count(),
            'disetujui' => FormPengajuan::where('id_status', 4)->count(),
            'selesai' => FormPengajuan::where('id_status', 5)->count()
        ];

        $monthlyStats = FormPengajuan::selectRaw('id_status, COUNT(*) as total')
            ->groupBy('id_status')
            ->get();

        $chartData = [
            'labels' => ['Status Pengajuan'],
            'entriOperator' => [$monthlyStats->where('id_status', 1)->first()?->total ?? 0],
            'pengecekanDokumen' => [$monthlyStats->where('id_status', 2)->first()?->total ?? 0],
            'disetujui' => [$monthlyStats->where('id_status', 3)->first()?->total ?? 0],
            'ditolak' => [$monthlyStats->where('id_status', 4)->first()?->total ?? 0],
            'selesai' => [$monthlyStats->where('id_status', 5)->first()?->total ?? 0]
        ];

        return view('dashboard', compact('data', 'chartData'));
    }
}
