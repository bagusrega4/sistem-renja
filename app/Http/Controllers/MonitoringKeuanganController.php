<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Models\FormPengajuan;
use App\Models\FileKeuangan;
use App\Models\FileOperator;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $pengajuan = FormPengajuan::where('no_fp', $id)->first();
        $pegawai = Pegawai::where('nip_lama', $pengajuan->nip_pengaju)->first();
        $fileOperator = FileOperator::where('no_fp', $id)->first();

        return view('monitoring.keuangan.file', [
            'pengajuan' => $pengajuan,
            'pegawai' => $pegawai,
            'fileOperator' => $fileOperator
        ]);
    }

    public function accept()
    {
        return redirect()->route('monitoring.keuangan.file')->with('success', 'File Keuangan berhasil diupload.');
    }
    // public function reject(Request $request)
    // {
    //     $is_rejected = true;
    //     $request->validate([
    //         'catatan' => 'required|string|max:1000',
    //         'pengajuan_id' => 'required|exists:pengajuan,id',
    //     ]);

    //     $fileOperator = FileOperator::findOrFail($request->no_fp);
    //     $fileOperator->update([
    //         'catatan' => $request->catatan,
    //     ]);
    //     return redirect()->route('monitoring.keuangan.file', ['isRejected' => $is_rejected])->with('success', 'File Keuangan berhasil diupload.');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'buktiTransfer' => 'required|mimes:jpeg,jpg,png,pdf,doc,docx,xls,xlsx|max:4096',
            'spjHonorInnas' => 'required|mimes:jpeg,jpg,png,pdf,doc,docx,xls,xlsx|max:4096',
            'sspHonorInnas' => 'required|mimes:jpeg,jpg,png,pdf,doc,docx,xls,xlsx|max:4096',
            'fileLainya' => 'required|mimes:jpeg,jpg,png,pdf,doc,docx,xls,xlsx|max:4096',
        ]);

        $buktiTransfer = $request->file('buktiTransfer')->store('uploads/file_keuangan', 'public');
        $spjHonorInnas = $request->file('spjHonorInnas')->store('uploads/file_keuangan', 'public');
        $sspHonorInnas = $request->file('sspHonorInnas')->store('uploads/file_keuangan', 'public');
        $fileLainya = $request->file('fileLainya')->store('uploads/file_keuangan', 'public');

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

    public function approve($id)
    {
        $pengajuan = FormPengajuan::where('no_fp', $id)->first();

        if (!$pengajuan) {
            return redirect()->back()->with('error', 'Form pengajuan tidak ditemukan.');
        }

        if (!in_array($pengajuan->status, [Status::ENTRI_DOKUMEN, Status::PENGECEKAN_DOKUMEN])) {
            return redirect()->back()->with('error', 'Form pengajuan tidak dapat diapprove pada status saat ini.');
        }

        $pengajuan->status = Status::DISETUJUI;

        $pengajuan->save();

        return redirect()->route('monitoring.keuangan.file', ['id' => $id])->with('success', 'Form pengajuan berhasil diapprove.');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'rejection_note' => 'required|string|max:1000',
        ]);

        $pengajuan = FormPengajuan::where('no_fp', $id)->first();

        if (!$pengajuan) {
            return redirect()->back()->with('error', 'Form pengajuan tidak ditemukan.');
        }

        if (!in_array($pengajuan->status, [Status::ENTRI_DOKUMEN, Status::PENGECEKAN_DOKUMEN])) {
            return redirect()->back()->with('error', 'Form pengajuan tidak dapat direject pada status saat ini.');
        }

        $pengajuan->status = Status::DITOLAK;
        $pengajuan->rejection_note = $request->rejection_note;
        $pengajuan->save();

        return redirect()->route('monitoring.keuangan.file', ['id' => $id])->with('success', 'Form pengajuan berhasil ditolak.');
    }
}
