<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\BukuPanduan;


class PanduanController extends Controller
{
    public function index()
    {
        // Ambil buku panduan terakhir berdasarkan waktu unggahan
        $bukuPanduanTerakhir = BukuPanduan::latest('created_at')->first();

        return view('panduan.index', compact('bukuPanduanTerakhir'));
    }


    public function upload(Request $request)
    {
        // Validasi file yang diunggah
        $request->validate([
            'file' => 'required|mimes:pdf|max:21000', // Hanya file PDF, maksimal 2MB
        ]);

        // Simpan file ke direktori public/storage/panduan
        $filePath = $request->file('file')->store('panduan', 'public');

        // Simpan data ke database
        BukuPanduan::create([
            'file' => $filePath,
        ]);

        return redirect()->route('panduan.index')->with('success', 'Buku panduan berhasil diunggah.');

}
}