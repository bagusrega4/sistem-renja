<?php

namespace App\Http\Controllers;

use App\Models\FormPengajuan;
use App\Models\Output;
use App\Models\Komponen;
use App\Models\SubKomponen;
use App\Models\AkunBelanja;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class FormController extends Controller
{
    // Menampilkan daftar form pengajuan
    public function index()
    {
        $output = Output::all();
        $komponen = Komponen::all();
        $subKomponen = SubKomponen::all();
        $akun = AkunBelanja::all();
        $formPengajuan = FormPengajuan::with(['output', 'komponen', 'subKomponen', 'akun', 'pegawai'])->get();
        return view('form.index', compact('formPengajuan','output','komponen','subKomponen','akun'));
    }

    // Menampilkan form untuk membuat pengajuan baru
    public function create()
    {
        $output = Output::all();
        $komponen = Komponen::all();
        $subKomponen = SubKomponen::all();
        $akun = AkunBelanja::all();
        return view('form.create', compact('output', 'komponen', 'subKomponen', 'akun'));
    }

    // Menyimpan data pengajuan baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_fp' => 'required|string|max:255',
            'id_output' => 'required|exists:output,id',
            'kode_komponen' => 'required|exists:komponen,kode',
            'kode_subkomponen' => 'required|exists:sub_komponen,kode',
            'kode_akun' => 'required|exists:akun_belanja,kode',
            'tanggal_mulai' => 'required|date',
            'tanggal_akhir' => 'required|date',
            'no_sk' => 'required|string|max:255',
            'uraian' => 'required|string|max:255',
            'nominal' => 'required|numeric| min:0|max:10000000000000000000000000',
            //'nip_pengaju' => 'required|exists:pegawai,niplama',
        ]);

        $formPengajuan = new FormPengajuan();
        $formPengajuan['no_fp'] = $request->no_fp;
        $formPengajuan['id_output'] = $request->id_output;
        $formPengajuan['kode_komponen'] = $request->kode_komponen;
        $formPengajuan['kode_subkomponen'] = $request->kode_subkomponen;
        $formPengajuan['kode_akun'] = $request->kode_akun;
        $formPengajuan['tanggal_mulai'] = $request->tanggal_mulai;
        $formPengajuan['tanggal_akhir'] = $request->tanggal_akhir;
        $formPengajuan['no_sk'] = $request->no_sk;
        $formPengajuan['uraian'] = $request->uraian;
        $formPengajuan['nominal'] = $request->nominal;
        $formPengajuan['nip_pengaju'] = 340015132;
        $formPengajuan -> save();
        
        return redirect()->route('form.index')->with('success', 'Form pengajuan berhasil disimpan.');
    }

    }
