<?php

namespace App\Http\Controllers;

use App\Models\ManageKegiatan;
use App\Models\Kegiatan;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->id_role == 3) {
            $kegiatanList = ManageKegiatan::with('kegiatan')->latest('id')->get();
        } else {
            // Selain admin -> hanya tampilkan sesuai tim_id user login
            $kegiatanList = ManageKegiatan::with('kegiatan')
                ->where('tim_id', $user->tim_id)
                ->latest('id')
                ->get();
        }

        return view('manage.kegiatan.index', compact('kegiatanList'));
    }

    public function create()
    {
        $kegiatan = Kegiatan::orderBy('nama_kegiatan')->get();
        return view('manage.kegiatan.create', compact('kegiatan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'periode_mulai'   => ['required', 'date', 'after_or_equal:today'],
            'periode_selesai' => ['required', 'date', 'after_or_equal:periode_mulai'],
            'deskripsi'       => ['nullable', 'string'],
            'kegiatan_id'     => ['nullable'],
        ]);

        $timId = auth()->user()->tim_id;

        if ($request->kegiatan_id === 'other') {
            $request->validate([
                'nama_kegiatan' => ['required', 'string', 'max:255'],
            ]);

            $kegiatanBaru = Kegiatan::create([
                'nama_kegiatan' => $request->nama_kegiatan,
            ]);

            ManageKegiatan::create([
                'kegiatan_id'     => $kegiatanBaru->id,
                'nama_kegiatan'   => $kegiatanBaru->nama_kegiatan,
                'deskripsi'       => $validated['deskripsi'] ?? null,
                'periode_mulai'   => $validated['periode_mulai'],
                'periode_selesai' => $validated['periode_selesai'],
                'status'          => 'aktif',
                'tim_id'          => $timId,
            ]);
        } else {
            $request->validate([
                'kegiatan_id' => ['required', 'exists:kegiatan,id'],
            ]);

            $kegiatan = Kegiatan::findOrFail($request->kegiatan_id);

            ManageKegiatan::create([
                'kegiatan_id'     => $kegiatan->id,
                'nama_kegiatan'   => $kegiatan->nama_kegiatan,
                'deskripsi'       => $validated['deskripsi'] ?? null,
                'periode_mulai'   => $validated['periode_mulai'],
                'periode_selesai' => $validated['periode_selesai'],
                'status'          => 'aktif',
                'tim_id'          => $timId,
            ]);
        }

        return redirect()
            ->route('manage.kegiatan.index')
            ->with('success', 'Kegiatan berhasil disimpan.');
    }

    public function selesai($id)
    {
        $kegiatan = ManageKegiatan::findOrFail($id);

        $kegiatan->update([
            'status' => 'selesai',
        ]);

        return redirect()
            ->route('manage.kegiatan.index')
            ->with('success', 'Kegiatan berhasil ditandai selesai.');
    }
}
