<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormPengajuan;
use App\Models\AkunBelanja;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FormPengajuanExport;

class DownloadController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $nipPengaju = $user->nip_lama;
        $idRole = $user->id_role;

        $akunBelanja = AkunBelanja::visible()->get();

        $tanggalMulai = $request->input('tanggal_mulai');
        $tanggalAkhir = $request->input('tanggal_akhir');
        $akun = $request->input('akun');

        $query = FormPengajuan::query();

        if ($idRole != 2 && $idRole != 3) {
            $query->where('nip_pengaju', $nipPengaju);
        }

        if ($tanggalMulai) {
            $query->where('tanggal_mulai', '>=', $tanggalMulai);
        }

        if ($tanggalAkhir) {
            $query->where('tanggal_akhir', '<=', $tanggalAkhir);
        }

        if ($akun) {
            $query->where('id_akun_belanja', $akun);
        }

        $formPengajuan = $query->get();

        return view('download.index', [
            'formPengajuan' => $formPengajuan,
            'akunBelanja' => $akunBelanja
        ]);
    }

    public function download(Request $request)
    {
        $selectedIds = $request->input('selected_ids');
        $format = $request->input('format', 'csv');

        if (!$selectedIds || empty($selectedIds)) {
            return back()->with('error', 'Pilih setidaknya satu data untuk diunduh.');
        }

        $data = FormPengajuan::with(['output', 'komponen', 'subKomponen', 'akunBelanja', 'formKeuangan'])
            ->whereIn('id', $selectedIds)
            ->get();

        $csvHeader = [
            'No. FP','Output','Komponen','Sub Komponen','Akun Belanja','Tanggal Mulai','Tanggal Akhir',
            'No. SK','Nama Permintaan','Nominal','NIP Pengaju','NIP Pengawas','No. SPBy','No. DRPP',
            'No. SPM', 'Tanggal SPM','Tanggal DRPP'
        ];

        $csvData = [];
        foreach ($data as $item) {
            $formKeuangan = $item->formKeuangan;
            $csvData[] = [
                $item->no_fp,
                $item->output?->output ?? '',
                $item->komponen?->komponen ?? '',
                $item->subKomponen?->sub_komponen ?? '',
                $item->akunBelanja->nama_akun ?? '',
                $item->tanggal_mulai,
                $item->tanggal_akhir,
                $item->no_sk,
                $item->uraian,
                $item->nominal,
                $item->nip_pengaju,
                $formKeuangan?->nip_pengawas ?? '',
                $formKeuangan?->no_spby ?? '',
                $formKeuangan?->no_drpp ?? '',
                $formKeuangan?->no_spm ?? '',
                $formKeuangan?->tanggal_spm ?? '',
                $formKeuangan?->tanggal_drpp ?? '',
            ];
        }

        $filenameBase = 'form_pengajuan_' . now()->format('YmdHis');

        if ($format === 'xlsx') {
            return Excel::download(new FormPengajuanExport($csvData, $csvHeader), $filenameBase . '.xlsx');
        } else {
            $filename = $filenameBase . '.csv';
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
}
