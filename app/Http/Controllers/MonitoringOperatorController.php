<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Tim;
use Illuminate\Http\Request;

class MonitoringOperatorController extends Controller
{
    public function upload(Request $request)
    {
        $user = auth()->user();

        // Ambil daftar tim (hanya untuk admin)
        $timList = $user->id_role == 3
            ? Tim::orderBy('nama_tim')->get()
            : collect();

        // Query dasar
        $query = Form::with(['manageKegiatan', 'user.pegawai'])
            ->orderBy('tanggal', 'desc');

        // Filter sesuai role
        if ($user->id_role == 1) {
            // Anggota tim → hanya data dirinya
            $query->where('user_id', $user->id);
        } elseif ($user->id_role == 2) {
            // Ketua tim → semua anggota timnya
            $query->where('tim_id', $user->tim_id);
        }
        // Admin (role 3) → default lihat semua data
        // kalau ada filter tim, baru difilter

        // ====== FILTER TAMBAHAN ======
        if ($request->filled('tim_id')) {
            $query->where('tim_id', $request->tim_id);
        }

        if ($request->filled('nama')) {
            $query->whereHas('user.pegawai', function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->nama . '%');
            });
        }

        if ($request->filled('kegiatan')) {
            $query->whereHas('manageKegiatan', function ($q) use ($request) {
                $q->where('nama_kegiatan', 'like', '%' . $request->kegiatan . '%');
            });
        }

        if ($request->filled('periode_mulai') && $request->filled('periode_selesai')) {
            // Jika dua-duanya diisi → cek overlap
            $query->whereHas('manageKegiatan', function ($q) use ($request) {
                $q->whereDate('periode_mulai', '<=', $request->periode_selesai)
                    ->whereDate('periode_selesai', '>=', $request->periode_mulai);
            });
        } elseif ($request->filled('periode_mulai')) {
            // Jika hanya periode_mulai diisi → kegiatan yg masih aktif/selesai setelah tanggal ini
            $query->whereHas('manageKegiatan', function ($q) use ($request) {
                $q->whereDate('periode_selesai', '>=', $request->periode_mulai);
            });
        } elseif ($request->filled('periode_selesai')) {
            // Jika hanya periode_selesai diisi → kegiatan yg sudah dimulai sebelum tanggal ini
            $query->whereHas('manageKegiatan', function ($q) use ($request) {
                $q->whereDate('periode_mulai', '<=', $request->periode_selesai);
            });
        }

        $rencanaKerja = $query->get();

        return view('monitoring.operator.upload', compact('rencanaKerja', 'timList'));
    }

    public function updateStatus(Request $request, $id)
    {
        $form = Form::findOrFail($id);
        $user = auth()->user();

        $request->validate([
            'diketahui' => 'nullable|boolean'
        ]);

        if ($user->id_role == 3 || ($user->id_role == 2 && $form->tim_id == $user->tim_id)) {
            $form->diketahui = $request->boolean('diketahui') ? 1 : 0;
            $form->save();

            return back()->with('success', 'Status berhasil diperbarui.');
        }

        return back()->with('error', 'Anda tidak berhak mengubah status ini.');
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'kegiatan_id' => 'required|exists:kegiatan,id',
            'tanggal'     => 'required|date',
            'jam_mulai'   => 'required',
            'jam_akhir'   => 'required',
        ]);

        Form::create([
            'user_id'     => $user->id,
            'tim_id'      => $user->tim_id,
            'kegiatan_id' => $request->kegiatan_id,
            'tanggal'     => $request->tanggal,
            'jam_mulai'   => $request->jam_mulai,
            'jam_akhir'   => $request->jam_akhir,
            'diketahui'   => 0
        ]);

        return back()->with('success', 'Form berhasil disimpan.');
    }
}
