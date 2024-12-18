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
        $akunBelanja = AkunBelanja::all();
        $formPengajuan = FormPengajuan::with(['output', 'komponen', 'subKomponen', 'akunBelanja', 'pegawai'])->get();
        return view('form.index', compact('formPengajuan','output','komponen','subKomponen','akunBelanja'));
    }

    // Menampilkan form untuk membuat pengajuan baru
    public function create()
    {
        $output = Output::all();
        $komponen = Komponen::all();
        $subKomponen = SubKomponen::all();
        $akunBelanja = AkunBelanja::all();
        return view('form.create', compact('output', 'komponen', 'subKomponen', 'akunBelanja'));
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
            'nominal' => 'required|numeric| min:0|max:1000000000000',
            // 'nip_pengaju' => 'required|exists:pegawai,nip_lama',
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
        $formPengajuan['nip_pengaju'] = auth()->user()->nip_lama;
        $formPengajuan -> save();

        return redirect()->route('monitoring.operator')->with('success', 'Form pengajuan berhasil disimpan.');
    }

    //this method will show edit product page
    public function edit($no_fp)
    {

        $formPengajuan = FormPengajuan::find($no_fp);
        $output = Output::all();
        $komponen = Komponen::all();
        $subKomponen = SubKomponen::all();
        $akunBelanja = AkunBelanja::all();
        return view('form.edit', compact('formPengajuan','output','komponen','subKomponen','akunBelanja'));
    }

    //this method will update a product
    public function update(Request $request, $no_fp)
    {

        $request->validate([

            'id_output' => 'required|exists:output,id',
            'kode_komponen' => 'required|exists:komponen,kode',
            'kode_subkomponen' => 'required|exists:sub_komponen,kode',
            'kode_akun' => 'required|exists:akun_belanja,kode',
            'tanggal_mulai' => 'required|date|before_or_equal:tanggal_akhir',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_mulai',
            'no_sk' => 'required|string|max:255',
            'uraian' => 'required|string|max:255',
            'nominal' => 'required|numeric|min:0|max:100000000000',

        ]);

        $formPengajuan=FormPengajuan::find($no_fp);
        $formPengajuan->update([
            'id_output' => $request->id_output,
            'kode_komponen' => $request->kode_komponen,
            'kode_subkomponen' => $request->kode_subkomponen,
            'kode_akun' => $request->kode_akun,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_akhir' => $request->tanggal_akhir,
            'no_sk' => $request->no_sk,
            'uraian' => $request->uraian,
            'nominal' => $request->nominal,
        ]);


        $formPengajuan->save();

        // Redirect ke halaman monitoring dengan pesan sukses
        return redirect()
            ->route('monitoring.operator')
            ->with('success', 'Form pengajuan berhasil diperbarui.');
    }

    //this method will delete a product
    // public function destroy($id)
    // {
    //     $product = Product::find($id);

    //     if (!$product) {
    //         return redirect()->route('products.index')->with('error', 'Product not found');
    //     }

    //     $product->delete();

    //     return redirect()->route('products.index')->with('message', 'Product deleted successfully');
    // }

    }
