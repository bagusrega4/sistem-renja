<?php

namespace App\Http\Controllers;

use App\Models\AkunBelanja;
use App\Models\Komponen;
use App\Models\SubKomponen;
use App\Models\Output;
use App\Models\Kegiatan;
use App\Models\KRO;
use Illuminate\Http\Request;

class ManageMAKController extends Controller
{
    // Controller Akun Belanja
    public function akun()
    {
        $accounts = AkunBelanja::all();
        return view('manage.mak.akun.index', [
            'accounts' => $accounts
        ]);
    }

    public function createAkun()
    {
        return view('manage.mak.akun.create');
    }

    public function storeAkun(Request $request)
    {
        $request->validate([
            'kode' => 'required|string|max:6',
            'nama_akun' => 'required|string|max:100',
        ]);

        AkunBelanja::create([
            'kode' => $request->kode,
            'nama_akun' => $request->nama_akun,
            'flag' => $request->flag ?? 1,
        ]);

        return redirect()->route('manage.mak.akun')->with('success', 'Akun berhasil ditambahkan.');
    }

    // Controller Komponen
    public function komponen()
    {
        $components = Komponen::all();
        return view('manage.mak.komponen.index', [
            'components' => $components
        ]);
    }

    public function createKomponen()
    {
        return view('manage.mak.komponen.create');
    }

    public function storeKomponen(Request $request)
    {
        $request->validate([
            'kode' => 'required|string|max:3',
            'komponen' => 'required|string|max:100',
        ]);

        Komponen::create([
            'kode' => $request->kode,
            'komponen' => $request->komponen,
            'flag' => $request->flag ?? 1,
        ]);

        return redirect()->route('manage.mak.komponen')->with('success', 'Komponen berhasil ditambahkan.');
    }

    // Controller Sub Komponen
    public function subkomponen()
    {
        $subcomponents = SubKomponen::all();
        return view('manage.mak.subkomponen.index', [
            'subcomponents' => $subcomponents
        ]);
    }

    public function createSubKomponen()
    {
        return view('manage.mak.subkomponen.create');
    }

    public function storeSubKomponen(Request $request)
    {
        $request->validate([
            'kode' => 'required|string|size:1',
            'sub_komponen' => 'required|string|max:100',
        ]);

        SubKomponen::create([
            'kode' => $request->kode,
            'sub_komponen' => $request->sub_komponen,
            'flag' => $request->flag ?? 1,
        ]);

        return redirect()->route('manage.mak.subkomponen')->with('success', 'SubKomponen berhasil ditambahkan.');
    }

    // Controller Kegiatan
    public function kegiatan()
    {
        $kegiatans = Kegiatan::all();
        return view('manage.mak.kegiatan.index', [
            'kegiatans' => $kegiatans
        ]);
    }

    public function createKegiatan()
    {
        return view('manage.mak.kegiatan.create');
    }

    public function storeKegiatan(Request $request)
    {
        $request->validate([
            'kode' => 'required|integer|digits:4|unique:kegiatan,kode',
            'kegiatan' => 'required|string|max:255',
        ]);

        Kegiatan::create([
            'kode' => $request->kode,
            'kegiatan' => $request->kegiatan,
            'flag' => $request->flag ?? 1,
        ]);

        return redirect()->route('manage.mak.kegiatan')->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    // Controller KRO
    public function kro()
    {
        $kros = KRO::all();
        return view('manage.mak.kro.index', [
            'kros' => $kros
        ]);
    }

    public function createKro()
    {
        return view('manage.mak.kro.create');
    }

    public function storeKro(Request $request)
    {
        $request->validate([
            'kode' => 'required|string|max:3',
            'kro' => 'required|string|max:100',
        ]);

        KRO::create([
            'kode' => $request->kode,
            'kro' => $request->komponen,
            'flag' => $request->flag ?? 1,
        ]);

        return redirect()->route('manage.mak.kro')->with('success', 'KRO berhasil ditambahkan.');
    }

    // Controller Output
    public function output()
    {
        $outputs = Output::all();
        return view('manage.mak.output.index', [
            'outputs' => $outputs
        ]);
    }

    public function createOutput()
    {
        $kegiatans = Kegiatan::where('flag', 1)->get();
        $kros = Kro::where('flag', 1)->get();

        return view('manage.mak.output.create', compact('kegiatans', 'kros'));
    }

    public function storeOutput(Request $request)
    {
        $request->validate([
            'id_kegiatan' => 'required|exists:kegiatan,id',
            'id_kro' => 'required|exists:kro,id',
            'kode_ro' => 'required|string|max:3',
            'output' => 'required|string|max:255',
        ]);

        Output::create([
            'id_kegiatan' => $request->id_kegiatan,
            'id_kro' => $request->id_kro,
            'kode_ro' => $request->kode_ro,
            'output' => $request->output,
            'flag' => $request ->flag ?? 1,
        ]);

        return redirect()->route('manage.mak.output')->with('success', 'Output berhasil ditambahkan.');
    }

    // Controller Update Flag
    public function updateFlagAkun(Request $request, $id)
    {
        $request->validate([
            'flag' => 'required|boolean',
        ]);

        $akun = AkunBelanja::findOrFail($id);
        $akun->flag = $request->flag;
        $akun->save();

        return redirect()->back()->with('success', 'Flag Akun berhasil diperbarui.');
    }

    public function updateFlagKomponen(Request $request, $id)
    {
        $request->validate([
            'flag' => 'required|boolean',
        ]);

        $komponen = Komponen::findOrFail($id);
        $komponen->flag = $request->flag;
        $komponen->save();

        return redirect()->back()->with('success', 'Flag Komponen berhasil diperbarui.');
    }

    public function updateFlagSubKomponen(Request $request, $id)
    {
        $request->validate([
            'flag' => 'required|boolean',
        ]);

        $subkomponen = SubKomponen::findOrFail($id);
        $subkomponen->flag = $request->flag;
        $subkomponen->save();

        return redirect()->back()->with('success', 'Flag SubKomponen berhasil diperbarui.');
    }

    public function updateFlagKegiatan(Request $request, $id)
    {
        $request->validate([
            'flag' => 'required|boolean',
        ]);

        $kegiatan = Kegiatan::findOrFail($id);
        $kegiatan->flag = $request->flag;
        $kegiatan->save();

        return redirect()->back()->with('success', 'Flag Kegiatan berhasil diperbarui.');
    }

    public function updateFlagKro(Request $request, $id)
    {
        $request->validate([
            'flag' => 'required|boolean',
        ]);

        $kro = KRO::findOrFail($id);
        $kro->flag = $request->flag;
        $kro->save();

        return redirect()->back()->with('success', 'Flag KRO berhasil diperbarui.');
    }

    public function updateFlagOutput(Request $request, $id)
    {
        $request->validate([
            'flag' => 'required|boolean',
        ]);

        $output = Output::findOrFail($id);
        $output->flag = $request->flag;
        $output->save();

        return redirect()->back()->with('success', 'Flag Output berhasil diperbarui.');
    }
}
