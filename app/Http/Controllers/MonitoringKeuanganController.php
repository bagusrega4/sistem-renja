<?php

namespace App\Http\Controllers;

use App\Models\FormPengajuan;
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
        return view('monitoring.keuangan.file', ['pengajuan' => $pengajuan, 'pegawai' => $pegawai]);
    }
}
