<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Tim;
use App\Models\ManageKegiatan;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function index()
    {
        $timList = Tim::orderBy('nama_tim')->get();

        // Hanya ambil kegiatan aktif
        $kegiatanList = ManageKegiatan::where('status', 'aktif')
            ->orderBy('nama_kegiatan')
            ->get();

        $user = auth()->user();

        return view('form.index', compact('timList', 'kegiatanList', 'user'));
    }

    public function create()
    {
        $timList = Tim::orderBy('nama_tim')->get();

        $kegiatanList = ManageKegiatan::where('status', 'aktif')
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
            'kegiatan_id' => 'required|exists:manage_kegiatan,id',
            'tanggal'     => ['required', 'date', 'after_or_equal:today'],
            'jam_mulai'   => 'required|date_format:H:i',
            'jam_akhir'   => 'required|date_format:H:i|after:jam_mulai',
        ];

        // Admin (1) & Ketua Tim (2) wajib pilih tim
        if (in_array($user->id_role, [1, 2])) {
            $rules['tim_id'] = 'required|exists:tims,id';
        }

        $request->validate($rules);

        // Tentukan tim_id berdasarkan role
        if ($user->id_role == 1 || $user->id_role == 2) {
            // Admin & ketua tim bisa pilih tim dari form
            $timId = $request->tim_id;
        } elseif ($user->id_role == 3) {
            // Anggota hanya bisa pakai tim dia sendiri
            $timId = $user->tim_id;
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

    public function getKegiatan($tim_id)
    {
        // hanya ambil kegiatan yg aktif dan sesuai tim
        $kegiatan = \App\Models\ManageKegiatan::where('tim_id', $tim_id)
            ->where('status', 'aktif')
            ->orderBy('nama_kegiatan')
            ->get();

        return response()->json($kegiatan);
    }

    public function destroy($id)
    {
        $form = Form::findOrFail($id);

        if ($form->diketahui) {
            return redirect()->back()->with('error', 'Rencana kerja sudah diketahui ketua, tidak bisa dihapus.');
        }

        $form->delete();

        return redirect()->back()->with('success', 'Rencana kerja berhasil dihapus.');
    }
}
