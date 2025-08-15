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
        $timList = Tim::orderBy('nama_tim')->get();
        $kegiatanList = Kegiatan::orderBy('nama_kegiatan')->get();
        $user = auth()->user();

        return view('form.index', compact('timList', 'kegiatanList', 'user'));
    }

    public function create()
    {
        $timList = Tim::orderBy('nama_tim')->get();
        $kegiatanList = Kegiatan::orderBy('nama_kegiatan')->get();
        $user = auth()->user();

        return view('form.create', compact('timList', 'kegiatanList', 'user'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        // Validasi umum
        $request->validate([
            'kegiatan_id' => 'required|exists:kegiatan,id',
            'tanggal'     => 'required|date',
            'jam_mulai'   => 'required|date_format:H:i',
            'jam_akhir'   => 'required|date_format:H:i|after:jam_mulai',
        ]);

        // Tentukan tim_id berdasarkan role
        if (in_array($user->id_role, [2, 3])) {
            $timId = $user->tim_id; // otomatis dari user
        } elseif ($user->id_role == 1) {
            $request->validate([
                'tim_id' => 'required|exists:tims,id',
            ]);
            $timId = $request->tim_id;
        } else {
            // Kalau ada role lain, default pakai tim user
            $timId = $user->tim_id;
        }

        // Simpan data
        Form::create([
            'user_id'     => $user->id,
            'tim_id'      => $timId,
            'kegiatan_id' => $request->kegiatan_id,
            'tanggal'     => $request->tanggal,
            'jam_mulai'   => $request->jam_mulai,
            'jam_akhir'   => $request->jam_akhir,
        ]);

        return redirect()->back()->with('success', 'Rencana kerja berhasil disimpan!');
    }
}
