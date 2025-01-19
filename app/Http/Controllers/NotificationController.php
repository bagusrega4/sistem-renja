<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\FormPengajuan;

class NotificationController extends Controller
{
    public function index()
{
    $pengajuanSelesai = FormPengajuan::where('id_status', 5)->where('is_opened', false)->get();
    $pengajuanDitolak = FormPengajuan::where('id_status', 3)->where('is_opened', false)->get();

    $unreadNotifCount = $pengajuanSelesai->count() + $pengajuanDitolak->count();

    return view('notifications.index', [
        'pengajuanSelesai' => $pengajuanSelesai,
        'pengajuanDitolak' => $pengajuanDitolak,
        'unreadNotifCount' => $unreadNotifCount,
    ]);
}


    public function markAsRead($id)
    {
        $pengajuan = FormPengajuan::findOrFail($id);
        $pengajuan->is_opened = true;
        $pengajuan->save();

        // Hitung jumlah notifikasi baru
        $newNotifCount = FormPengajuan::where('is_opened', false)->count();

        return response()->json([
            'success' => true,
            'message' => 'Notifikasi berhasil ditandai sebagai telah dibaca.',
            'newNotifCount' => $newNotifCount,
        ]);
    }

    public function seeAll()
    {
        $allPengajuan = FormPengajuan::all();
        return view('notifications.all', compact('allPengajuan'));
    }

}
