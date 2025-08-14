<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;

class MonitoringOperatorController extends Controller
{
    public function upload()
    {
        $user = auth()->user();

        // Query dengan relasi kegiatan + user + pegawai
        $query = Form::with(['kegiatan', 'user.pegawai'])
            ->orderBy('tanggal', 'desc');

        // Filter sesuai role
        match ($user->id_role) {
            2 => $query->where('tim_id', $user->tim_id), // Ketua tim
            1 => $query->where('user_id', $user->id),    // Anggota tim
            default => $query // Admin: semua data
        };

        $rencanaKerja = $query->get();

        return view('monitoring.operator.upload', compact('rencanaKerja'));
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
