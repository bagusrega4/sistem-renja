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
        $user = auth()->user();
        $nipPengaju = $user->nip_lama;
        $idRole = $user->id_role;

        if ($idRole == 1) {
            $formPengajuan = FormPengajuan::where('nip_pengaju', $nipPengaju)->get();
        } else {
            $formPengajuan = FormPengajuan::all();
        }

        $data = [
            'totalPengajuan' => $formPengajuan->count(),
            'entriOperator' => $formPengajuan->where('id_status', 1)->count(),
            'pengecekanDokumen' => $formPengajuan->where('id_status', 2)->count(),
            'ditolak' => $formPengajuan->where('id_status', 3)->count(),
            'disetujui' => $formPengajuan->where('id_status', 4)->count(),
            'selesai' => $formPengajuan->where('id_status', 5)->count()
        ];

        $chartData = [
            'labels' => ['Status Pengajuan'],
            'entriOperator' => [$formPengajuan->where('id_status', 1)->count()],
            'pengecekanDokumen' => [$formPengajuan->where('id_status', 2)->count()],
            'disetujui' => [$formPengajuan->where('id_status', 4)->count()],
            'ditolak' => [$formPengajuan->where('id_status', 3)->count()],
            'selesai' => [$formPengajuan->where('id_status', 5)->count()]
        ];

        return view('dashboard', compact('data', 'chartData', 'formPengajuan'));
    }

}
