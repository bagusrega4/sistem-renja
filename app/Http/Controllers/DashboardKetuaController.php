<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Form;
use App\Models\Tim;
use Carbon\Carbon;

class DashboardKetuaController extends Controller
{
    public function index(Request $request)
    {
        $selectedYear = $request->get('year', Carbon::now()->year);

        // --- daftar tahun untuk dropdown ---
        $availableYears = Form::selectRaw('YEAR(tanggal) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year')
            ->toArray();

        // --- KPI CARDS ---
        $totalDinasTahun = Form::whereYear('tanggal', $selectedYear)->count();

        $totalDinasBulan = Form::whereYear('tanggal', $selectedYear)
            ->whereMonth('tanggal', Carbon::now()->month)
            ->count();

        $timPalingAktif = Form::select('tim_id', DB::raw('COUNT(*) as total'))
            ->whereYear('tanggal', $selectedYear)
            ->groupBy('tim_id')
            ->orderByDesc('total')
            ->with('tim')
            ->first();

        $timPalingAktifNama = $timPalingAktif && $timPalingAktif->tim
            ? $timPalingAktif->tim->nama_tim
            : '-';

        $rataRataBulan = $totalDinasTahun > 0 ? round($totalDinasTahun / 12, 1) : 0;

        // --- PIE DATA (persentase per tim) ---
        $pie = Form::select('tim_id', DB::raw('COUNT(*) as total'))
            ->whereYear('tanggal', $selectedYear)
            ->groupBy('tim_id')
            ->with('tim')
            ->get();

        $pieLabels = $pie->pluck('tim.nama_tim');
        $pieData   = $pie->pluck('total');

        // --- BAR DATA (top tim) ---
        $bar       = $pie->sortByDesc('total')->take(5);
        $barLabels = $bar->pluck('tim.nama_tim');
        $barData   = $bar->pluck('total');

        // --- LINE DATA (tren bulanan per tim) ---
        $lineLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

        $timList = Tim::pluck('nama_tim', 'id'); // lebih aman dari DB::table
        $lineDatasets = [];

        // pakai palet warna supaya konsisten (bukan random)
        $colors = ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#858796', '#20c997', '#6f42c1'];

        foreach ($timList as $timId => $timNama) {
            $data = [];
            for ($bulan = 1; $bulan <= 12; $bulan++) {
                $count = Form::whereYear('tanggal', $selectedYear)
                    ->whereMonth('tanggal', $bulan)
                    ->where('tim_id', $timId)
                    ->count();
                $data[] = $count;
            }
            $lineDatasets[] = [
                'label' => $timNama,
                'data' => $data,
                'borderWidth' => 2,
                'fill' => false,
                'borderColor' => $colors[$timId % count($colors)]
            ];
        }

        // --- STACKED BAR DATA (Distribusi Jenis Kegiatan per Tim) ---
        $jenisKegiatanData = Form::select(
            'tims.nama_tim',
            'kegiatan.nama_kegiatan',
            DB::raw('COUNT(*) as total')
        )
            ->join('tims', 'forms.tim_id', '=', 'tims.id')
            ->join('kegiatan', 'forms.kegiatan_id', '=', 'kegiatan.id')
            ->whereYear('forms.tanggal', $selectedYear)
            ->groupBy('tims.nama_tim', 'kegiatan.nama_kegiatan')
            ->get();

        $timLabels   = $jenisKegiatanData->pluck('nama_tim')->unique()->values();
        $jenisLabels = $jenisKegiatanData->pluck('nama_kegiatan')->unique()->values();

        $stackedDatasets = [];
        $colorsStacked = ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#858796'];

        foreach ($jenisLabels as $i => $jenis) {
            $data = [];
            foreach ($timLabels as $tim) {
                $row = $jenisKegiatanData
                    ->where('nama_tim', $tim)
                    ->where('nama_kegiatan', $jenis)
                    ->first();
                $data[] = $row ? $row->total : 0;
            }
            $stackedDatasets[] = [
                'label' => $jenis,
                'data' => $data,
                'backgroundColor' => $colorsStacked[$i % count($colorsStacked)]
            ];
        }

        return view('dashboardKetua', compact(
            'selectedYear',
            'availableYears',
            'totalDinasTahun',
            'totalDinasBulan',
            'timPalingAktifNama',
            'rataRataBulan',
            'pieLabels',
            'pieData',
            'barLabels',
            'barData',
            'lineLabels',
            'lineDatasets',
            'timLabels',
            'stackedDatasets'
        ));
    }
}
