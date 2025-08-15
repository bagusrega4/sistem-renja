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
            'nama_kegiatan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $kegiatan = Kegiatan::create([
            'nama_kegiatan' => $request->nama_kegiatan,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()
            ->route('manage.kegiatan.index')
            ->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        $kegiatan->delete();

        return redirect()
            ->route('manage.kegiatan.index')
            ->with('success', 'Kegiatan berhasil dihapus.');
    }
}
