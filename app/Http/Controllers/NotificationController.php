<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\FormPengajuan;

class NotificationController extends Controller
{
    public function index()
    {
        $pengajuanSelesai = FormPengajuan::where('id_status', 5)->get();
        $pengajuanDitolak = FormPengajuan::where('id_status', 3)->get();

        return view('notifications.index', [
            'pengajuanSelesai' => $pengajuanSelesai,
            'pengajuanDitolak' => $pengajuanDitolak,
        ]);
    }
}
