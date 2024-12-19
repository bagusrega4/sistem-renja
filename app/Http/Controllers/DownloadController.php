<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormPengajuan;
use App\Models\AkunBelanja;
use Illuminate\Support\Facades\Response;

class DownloadController extends Controller
{
    // Menampilkan halaman filter & tabel
    public function index(Request $request)
    {
        // Ambil daftar akun belanja untuk dropdown filter
        $akunBelanja = AkunBelanja::visible()->get();

        // Ambil filter dari request
        $tanggalMulai = $request->input('tanggal_mulai');
        $tanggalAkhir = $request->input('tanggal_akhir');
        $akun = $request->input('akun');

        // Query dasar untuk tabel
        $query = FormPengajuan::query();

        if ($tanggalMulai) {
            $query->where('tanggal_mulai', '>=', $tanggalMulai);
        }

        if ($tanggalAkhir) {
            $query->where('tanggal_akhir', '<=', $tanggalAkhir);
        }

        if ($akun) {
            $query->where('kode_akun', $akun);
        }

        $formPengajuan = $query->get();

        return view('download.index', [
            'formPengajuan' => $formPengajuan,
            'akunBelanja' => $akunBelanja
        ]);
    }

    // Proses download data yang dipilih
    public function download(Request $request)
    {
        $selectedIds = $request->input('selected_ids');

        if (!$selectedIds || empty($selectedIds)) {
            return back()->with('error', 'Pilih setidaknya satu data untuk diunduh.');
        }

        // Ambil data berdasarkan ID yang dipilih dengan semua relasi
        $data = FormPengajuan::with(['output', 'komponen', 'subKomponen', 'akunBelanja', 'pegawai'])
            ->whereIn('no_fp', $selectedIds)
            ->get();

        // Konversi data ke CSV
        $csvHeader = ['No FP', 'Tanggal Kegiatan', 'Nama Permintaan', 'Kode Akun', 'Nominal', 'Output', 'Komponen', 'SubKomponen', 'Pegawai'];
        $csvData = [];
        foreach ($data as $item) {
            $csvData[] = [
                $item->no_fp,
                $item->tanggal_mulai . ' - ' . $item->tanggal_akhir,
                $item->uraian,
                $item->kode_akun,
                $item->nominal,
                $item->output->nama ?? '', // Pastikan data ini tidak null
                $item->komponen->nama ?? '', // Pastikan data ini tidak null
                $item->subKomponen->nama ?? '', // Pastikan data ini tidak null
                $item->pegawai->nama ?? '' // Pastikan data ini tidak null
            ];
        }

        $filename = 'form_pengajuan_' . now()->format('YmdHis') . '.csv';
        $handle = fopen('php://temp', 'w');
        fputcsv($handle, $csvHeader);

        foreach ($csvData as $line) {
            fputcsv($handle, $line);
        }

        rewind($handle);
        $content = stream_get_contents($handle);
        fclose($handle);

        return Response::make($content, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$filename",
        ]);
    }
}
