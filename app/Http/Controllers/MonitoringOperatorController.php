<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormPengajuan;
use App\Models\FileOperator;

class MonitoringOperatorController extends Controller
{
    public function index()
    {
        // Mengambil data form pengajuan
        $formPengajuan = FormPengajuan::get();
        return view('monitoring.operator.index', compact('formPengajuan'));
    }

    public function upload($no_fp)
    {
        $form = FormPengajuan::find($no_fp);
        return view('monitoring.operator.upload', compact('form'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_fp' => 'required|exists:form_pengajuan,no_fp|unique:file_operator,no_fp',
            'nama_permintaan' => 'required|exists:form_pengajuan,uraian',
            'kak_ttd' => 'required|image|mimes:jpeg,jpg,png|max:4096',
            'surat_tugas' => 'required|image|mimes:jpeg,jpg,png|max:4096',
            'sk_kpa' => 'required|image|mimes:jpeg,jpg,png|max:4096',
            'laporan_innas' => 'required|image|mimes:jpeg,jpg,png|max:4096',
            'daftar_hadir' => 'required|image|mimes:jpeg,jpg,png|max:4096',
            'absen_harian' => 'required|image|mimes:jpeg,jpg,png|max:4096',
            'rekap_norek_innas' => 'required|image|mimes:jpeg,jpg,png|max:4096',
        ]);
        // Menyimpan file dan mendapatkan path
        $kak_ttdPath = $request->file('kak_ttd')->store('uploads/file_operator', 'public');
        $surat_tugasPath = $request->file('surat_tugas')->store('uploads/file_operator', 'public');
        $sk_kpaPath = $request->file('sk_kpa')->store('uploads/file_operator', 'public');
        $laporan_innasPath = $request->file('laporan_innas')->store('uploads/file_operator', 'public');
        $daftar_hadirPath = $request->file('daftar_hadir')->store('uploads/file_operator', 'public');
        $absen_harianPath = $request->file('absen_harian')->store('uploads/file_operator', 'public');
        $rekap_norek_innasPath = $request->file('rekap_norek_innas')->store('uploads/file_operator', 'public');

        // Membuat entri baru di tabel file_operator
        FileOperator::create([
            'no_fp' => $request->no_fp,
            'nama_permintaan' => $request->nama_permintaan,
            'kak_ttd' => $kak_ttdPath,
            'surat_tugas' => $surat_tugasPath,
            'sk_kpa' => $sk_kpaPath,
            'laporan_innas' => $laporan_innasPath,
            'daftar_hadir' => $daftar_hadirPath,
            'absen_harian' => $absen_harianPath,
            'rekap_norek_innas' => $rekap_norek_innasPath,
        ]);

        return redirect()->route('monitoring.operator.index')->with('success', 'File Operator berhasil diupload.');
    }
}
