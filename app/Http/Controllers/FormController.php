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

        // Hanya ambil kegiatan aktif
        $kegiatanList = Kegiatan::where('status', 'aktif')
            ->orderBy('nama_kegiatan')
            ->get();

        $user = auth()->user();

        return view('form.index', compact('timList', 'kegiatanList', 'user'));
    }

    public function create()
    {
        $timList = Tim::orderBy('nama_tim')->get();

        // Hanya ambil kegiatan aktif
        $kegiatanList = Kegiatan::where('status', 'aktif')
            ->orderBy('nama_kegiatan')
            ->get();

        $user = auth()->user();

        return view('form.create', compact('timList', 'kegiatanList', 'user'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        // Validasi umum
        $rules = [
            'kegiatan_id' => 'required|exists:kegiatan,id',
            'tanggal'     => ['required', 'date', 'after_or_equal:today'],
            'jam_mulai'   => 'required|date_format:H:i',
            'jam_akhir'   => 'required|date_format:H:i|after:jam_mulai',
        ];

        // Kalau role admin (id_role == 1) maka wajib pilih tim
        if ($user->id_role == 1) {
            $rules['tim_id'] = 'required|exists:tims,id';
        }

        $request->validate($rules);

        // Tentukan tim_id berdasarkan role
        if (in_array($user->id_role, [2, 3])) {
            $timId = $user->tim_id;
        } elseif ($user->id_role == 1) {
            $timId = $request->tim_id;
        } else {
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
