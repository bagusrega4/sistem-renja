<?php

namespace App\Http\Controllers;

use App\Models\FormPengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\BukuPanduan;


class PanduanController extends Controller
{
    public function index()
    {
        $formPengajuan = FormPengajuan::all();

        $bukuPanduanTerakhir = BukuPanduan::latest('created_at')->first();

        return view('panduan.index', compact('bukuPanduanTerakhir', 'formPengajuan'));
    }


    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf|max:21000',
        ]);

        $filePath = $request->file('file')->store('panduan', 'public');

        BukuPanduan::create([
            'file' => $filePath,
        ]);

        return redirect()->route('panduan.index')->with('success', 'Buku panduan berhasil diunggah.');
    }
}
