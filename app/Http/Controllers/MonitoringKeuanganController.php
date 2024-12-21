<?php

namespace App\Http\Controllers;

use App\Models\FormPengajuan;
use App\Models\FileKeuangan;
use App\Models\FileOperator;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class MonitoringKeuanganController extends Controller
{
    public function index()
    {
        $pengajuan = FormPengajuan::all();
        foreach ($pengajuan as $p) {
            $pegawai = Pegawai::where('nip_lama', $p->nip_pengaju)->first();
        }
        return view('monitoring.keuangan.index', ['pengajuan' => $pengajuan, 'pegawai' => $pegawai]);
    }
    public function viewFile($id)
    {
        $pengajuan = FormPengajuan::all();
        foreach ($pengajuan as $p) {
            $pegawai = Pegawai::where('nip_lama', $p->nip_pengaju)->first();
        }
        $fileOperator = FileOperator::where('no_fp', $id)->first();
        return view('monitoring.keuangan.file', ['pengajuan' => $pengajuan, 'pegawai' => $pegawai, 'fileOperator' => $fileOperator]);
    }

    public function upload($no_fp)
    {
        $fileOperator = FileOperator::where('no_fp', $no_fp)->first();
        return view('monitoring.keuangan.upload', compact('fileOperator'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'buktiTransfer' => 'required|mimes:jpeg,jpg,png,pdf,doc,docx,xls,xlsx|max:4096',
            'spjHonorInnas' => 'required|mimes:jpeg,jpg,png,pdf,doc,docx,xls,xlsx|max:4096',
            'sspHonorInnas' => 'required|mimes:jpeg,jpg,png,pdf,doc,docx,xls,xlsx|max:4096',
            'fileLainya' => 'required|mimes:jpeg,jpg,png,pdf,doc,docx,xls,xlsx|max:4096',
        ]);

        $buktiTransfer = $request->file('buktiTransfer')->store('uploads/file_operator', 'public');
        $spjHonorInnas = $request->file('spjHonorInnas')->store('uploads/file_operator', 'public');
        $sspHonorInnas = $request->file('sspHonorInnas')->store('uploads/file_operator', 'public');
        $fileLainya = $request->file('fileLainya')->store('uploads/file_operator', 'public');

        FileKeuangan::create([
            'fileOperatorId' => $request->fileOperatorId,
            'noSPBy' => $request->noSPBy,
            'noDRPP' => $request->noDRPP,
            'noSPM' => $request->noSPM,
            'tanggal_SPM' => $request->tanggal_SPM,
            'tanggal_DRPP' => $request->tanggal_DRPP,
            'buktiTransfer' => $buktiTransfer,
            'spjHonorInnas' => $spjHonorInnas,
            'sspHonorInnas' => $sspHonorInnas,
            'fileLainya' => $fileLainya,
        ]);

        return redirect()->route('monitoring.keuangan.index')->with('success', 'File Keuangan berhasil diupload.');
    }
}
