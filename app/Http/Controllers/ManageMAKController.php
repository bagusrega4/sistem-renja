<?php

namespace App\Http\Controllers;

use App\Models\AkunBelanja;
use App\Models\Komponen;
use App\Models\SubKomponen;
use App\Models\Output;
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
            'akun_belanja' => 'required|string|max:255',
        ]);

        AkunBelanja::create([
            'kode' => $request->kode,
            'akun_belanja' => $request->akun_belanja,
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
        return view('manage.mak.output.create');
    }

    public function storeOutput(Request $request)
    {
        $request->validate([
            'kode_kegiatan' => 'required|integer|exists:kegiatan,kode',
            'kode_kro' => 'required|exists:kro,kode',
            'kode_ro' => 'required|exists:ro,kode',
            'output' => 'required|string|max:255',
        ]);

        Output::create([
            'kode_kegiatan' => $request->kode_kegiatan,
            'kode_kro' => $request->kode_kro,
            'kode_ro' => $request->kode_ro,
            'output' => $request->output,
            'flag' => $request ->flag ?? 1,
        ]);

        return redirect()->route('manage.mak.output')->with('success', 'Output berhasil ditambahkan.');
    }

    // Controller Update Flag
    public function updateFlagAkun(Request $request, $id)
    {
        $akun = AkunBelanja::findOrFail($id);
        $akun->flag = !$akun->flag;
        $akun->save();

        return redirect()->back()->with('success', 'Flag Akun berhasil diperbarui.');
    }

    public function updateFlagKomponen(Request $request, $id)
    {
        $komponen = Komponen::findOrFail($id);
        $komponen->flag = !$komponen->flag;
        $komponen->save();

        return redirect()->back()->with('success', 'Flag Komponen berhasil diperbarui.');
    }

    public function updateFlagSubKomponen(Request $request, $id)
    {
        $subkomponen = SubKomponen::findOrFail($id);
        $subkomponen->flag = !$subkomponen->flag;
        $subkomponen->save();

        return redirect()->back()->with('success', 'Flag SubKomponen berhasil diperbarui.');
    }

    public function updateFlagOutput(Request $request, $id)
    {
        $output = Output::findOrFail($id);
        $output->flag = !$output->flag;
        $output->save();

        return redirect()->back()->with('success', 'Flag Output berhasil diperbarui.');
    }
}
