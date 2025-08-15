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
        $query = Form::with(['kegiatan', 'user.pegawai'])
            ->orderBy('tanggal', 'desc');

        // Filter sesuai role
        if ($user->id_role == 1) {
            // Anggota tim
            $query->where('user_id', $user->id);
        } elseif ($user->id_role == 2) {
            // Ketua tim
            $query->where('tim_id', $user->tim_id);
        } elseif ($user->id_role == 3) {
            // Admin: tampilkan data hanya jika tim dipilih
            if ($request->filled('tim_id')) {
                $query->where('tim_id', $request->tim_id);
            } else {
                $query->whereRaw('1=0'); // kosongkan hasil
            }
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

        // Hanya admin atau ketua tim yang sesuai yang boleh update
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

        // Set tim_id otomatis untuk ketua tim & admin
        if (in_array($user->id_role, [2, 3])) {
            $request->merge(['tim_id' => $user->tim_id]);
        }

        Form::create([
            'user_id'     => $user->id,
            'tim_id'      => $request->tim_id ?? null,
            'kegiatan_id' => $request->kegiatan_id,
            'tanggal'     => $request->tanggal,
            'jam_mulai'   => $request->jam_mulai,
            'jam_akhir'   => $request->jam_akhir,
            'diketahui'   => 0
        ]);

        return back()->with('success', 'Form berhasil disimpan.');
    }
}
