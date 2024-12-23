<?php

namespace App\Http\Controllers;

use App\Models\FormPengajuan;
use App\Enums\Status;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'totalPengajuan' => FormPengajuan::count(),
            'entriDokumen' => FormPengajuan::where('status', Status::ENTRI_DOKUMEN)->count(),
            'pengecekanDokumen' => FormPengajuan::where('status', Status::PENGECEKAN_DOKUMEN)->count(),
            'disetujui' => FormPengajuan::where('status', Status::DISETUJUI)->count(),
            'ditolak' => FormPengajuan::where('status', Status::DITOLAK)->count(),
            'selesai' => FormPengajuan::where('status', Status::SELESAI)->count()
        ];

        $monthlyStats = FormPengajuan::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->get();

        $chartData = [
            'labels' => ['Status Pengajuan'],
            'entriDokumen' => [$monthlyStats->where('status', Status::ENTRI_DOKUMEN)->first()?->total ?? 0],
            'pengecekanDokumen' => [$monthlyStats->where('status', Status::PENGECEKAN_DOKUMEN)->first()?->total ?? 0],
            'disetujui' => [$monthlyStats->where('status', Status::DISETUJUI)->first()?->total ?? 0],
            'ditolak' => [$monthlyStats->where('status', Status::DITOLAK)->first()?->total ?? 0],
            'selesai' => [$monthlyStats->where('status', Status::SELESAI)->first()?->total ?? 0]
        ];

        return view('dashboard', compact('data', 'chartData'));
    }
}
