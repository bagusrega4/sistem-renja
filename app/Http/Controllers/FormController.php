<?php

namespace App\Http\Controllers;

use App\Models\FormPengajuan;
use App\Models\Output;
use App\Models\Komponen;
use App\Models\SubKomponen;
use App\Models\AkunBelanja;
use App\Models\StatusPengajuan;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function index()
    {
        $output = Output::visible()
            ->with(['kegiatan', 'kro'])
            ->get();
        $komponen = Komponen::visible()->get();
        $subKomponen = SubKomponen::visible()->get();
        $akunBelanja = AkunBelanja::visible()->orderBy('kode', 'asc')->get();
        $formPengajuan = FormPengajuan::with(['output', 'komponen', 'subKomponen', 'akunBelanja', 'user'])->get();
        return view('form.index', compact('formPengajuan', 'output', 'komponen', 'subKomponen', 'akunBelanja'));
    }

    public function store(Request $request)
    {
        try {
            // dd($request->all());
            $validated = $request->validate([
                'no_fp' => 'required|string|max:10',
                'id_output' => 'required|exists:output,id',
                'id_komponen' => 'required|exists:komponen,id',
                'id_subkomponen' => 'required|exists:sub_komponen,id',
                'id_akun_belanja' => 'required|exists:akun_belanja,id',
                'tanggal_mulai' => 'required|date|before_or_equal:tanggal_akhir',
                'tanggal_akhir' => 'required|date|after_or_equal:tanggal_mulai',
                'no_sk' => 'required|string|max:255',
                'uraian' => 'required|string|max:255',
                'nominal' => 'required|numeric|min:0|max:1000000000000',
            ]);

            $formPengajuan = FormPengajuan::create([
                'no_fp' => $request->no_fp,
                'id_output' => $request->id_output,
                'id_komponen' => $request->id_komponen,
                'id_subkomponen' => $request->id_subkomponen,
                'id_akun_belanja' => $request->id_akun_belanja,
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_akhir' => $request->tanggal_akhir,
                'no_sk' => $request->no_sk,
                'uraian' => $request->uraian,
                'nominal' => $request->nominal,
                'nip_pengaju' => auth()->user()->nip_lama,
                'id_status' => $request->id_status ?? 1
            ]);

            return redirect()->route('monitoring.operator.index')
                ->with('success', 'Form pengajuan berhasil disimpan.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.')
                ->withInput();
        }
    }


    public function edit($id)
    {
        $formPengajuan = FormPengajuan::all();

        $fp = FormPengajuan::find($id);

        if (!$fp || $fp->id_status != 1) {
            return view('error.unauthorized');
        }

        $nipPengaju = auth()->user()->nip_lama;
        $fp = FormPengajuan::where('id', $id)
            ->where('nip_pengaju', $nipPengaju)
            ->first();
        if (!$fp) {
            return redirect()->back()->with('error', 'Form pengajuan tidak ditemukan atau Anda tidak memiliki akses.');
        }

        $output = Output::visible()->get();
        $komponen = Komponen::visible()->get();
        $subKomponen = SubKomponen::visible()->get();
        $akunBelanja = AkunBelanja::visible()->get();
        return view('form.edit', compact('fp', 'output', 'komponen', 'subKomponen', 'akunBelanja', 'formPengajuan'));
    }

    public function update(Request $request, $id)
    {
        $fp = FormPengajuan::find($id);

        if (!$fp || $fp->id_status != 1) {
            return view('error.unauthorized');
        }

        $request->validate([
            'id_output' => 'required|exists:output,id',
            'id_komponen' => 'required|exists:komponen,id',
            'id_subkomponen' => 'required|exists:sub_komponen,id',
            'id_akun_belanja' => 'required|exists:akun_belanja,id',
            'tanggal_mulai' => 'required|date|before_or_equal:tanggal_akhir',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_mulai',
            'no_sk' => 'required|string|max:255',
            'uraian' => 'required|string|max:255',
            'nominal' => 'required|numeric|min:0|max:1000000000000',
        ]);

        $formPengajuan = FormPengajuan::findOrFail($id);
        $formPengajuan->update([
            'id_output' => $request->id_output,
            'id_komponen' => $request->id_komponen,
            'id_subkomponen' => $request->id_subkomponen,
            'id_akun_belanja' => $request->id_akun_belanja,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_akhir' => $request->tanggal_akhir,
            'no_sk' => $request->no_sk,
            'uraian' => $request->uraian,
            'nominal' => $request->nominal,
        ]);

        return redirect()->route('monitoring.operator.index')
            ->with('success', 'Form pengajuan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $formPengajuan = FormPengajuan::findOrFail($id);

        if (!$formPengajuan) {
            return redirect()->route('monitoring.operator')->with('error', 'Form pengajuan tidak ditemukan.');
        }

        $formPengajuan->delete();

        return redirect()->route('monitoring.operator.index')->with('success', 'Form pengajuan berhasil dihapus.');
    }
}
