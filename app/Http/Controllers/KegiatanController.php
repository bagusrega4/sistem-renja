<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function index()
    {
        $kegiatanList = Kegiatan::orderBy('id', 'desc')->get();
        return view('manage.kegiatan.index', compact('kegiatanList'));
    }

    public function create()
    {
        return view('manage.kegiatan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kegiatan'   => 'required|string|max:255',
            'deskripsi'       => 'nullable|string',
            'periode_mulai'   => 'required|date|after_or_equal:today',
            'periode_selesai' => 'required|date|after_or_equal:periode_mulai',
        ]);

        Kegiatan::create($request->only([
            'nama_kegiatan',
            'deskripsi',
            'periode_mulai',
            'periode_selesai'
        ]));

        return redirect()
            ->route('manage.kegiatan.index')
            ->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    public function selesai($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        $kegiatan->status = 'selesai';
        $kegiatan->save();

        return redirect()
            ->route('manage.kegiatan.index')
            ->with('success', 'Kegiatan berhasil ditandai selesai.');
    }
}
