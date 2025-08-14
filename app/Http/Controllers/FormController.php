<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Tim;
use App\Models\Kegiatan;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function index()
    {
        $timList = Tim::all();
        $kegiatanList = Kegiatan::all();
        return view('form.index', compact('timList', 'kegiatanList'));
    }

    public function create()
    {
        $timList = Tim::all();
        $kegiatanList = Kegiatan::all();
        return view('form.create', compact('timList', 'kegiatanList'));
    }

    public function store(Request $request)
    {
        // Validasi umum
        $request->validate([
            'kegiatan_id' => 'required|exists:kegiatan,id',
            'tanggal'     => 'required|date',
            'jam_mulai'   => 'required|date_format:H:i',
            'jam_akhir'   => 'required|date_format:H:i|after:jam_mulai',
        ]);

        // Role 2 & 3 → tim_id otomatis
        if (auth()->user()->id_role == 2 || auth()->user()->id_role == 3) {
            $timId = auth()->user()->tim_id;
        } else {
            // Selain itu → tim_id harus dipilih
            $request->validate([
                'tim_id' => 'required|exists:tims,id',
            ]);
            $timId = $request->tim_id;
        }

        // Simpan data
        Form::create([
            'user_id'     => auth()->id(),
            'tim_id'      => $timId,
            'kegiatan_id' => $request->kegiatan_id,
            'tanggal'     => $request->tanggal,
            'jam_mulai'   => $request->jam_mulai,
            'jam_akhir'   => $request->jam_akhir,
        ]);

        return redirect()->back()->with('success', 'Rencana kerja berhasil disimpan!');
    }
}
