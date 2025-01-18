<?php

namespace App\Http\Controllers;

use App\Models\FormPengajuan;
use App\Models\AkunBelanja;
use App\Models\Komponen;
use App\Models\JenisFileOperator;
use App\Models\JenisFileKeuangan;
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
        $formPengajuan = FormPengajuan::all();
        $accounts = AkunBelanja::all();
        return view('manage.mak.akun.index', [
            'accounts' => $accounts,
            'formPengajuan' => $formPengajuan
        ]);
    }

    public function createAkun()
    {
        $formPengajuan = FormPengajuan::all();
        $jenisFileOperator = JenisFileOperator::visible()->get();
        $jenisFileKeuangan = JenisFileKeuangan::visible()->get();
        return view('manage.mak.akun.create', ['jenisFileOperator' => $jenisFileOperator, 'formPengajuan' => $formPengajuan, 'jenisFileKeuangan' => $jenisFileKeuangan]);
    }

    public function storeAkun(Request $request)
    {
        $request->validate([
            'kode' => 'required|string|max:6',
            'nama_akun' => 'required|string|max:100',
        ]);

        $akunBelanja = AkunBelanja::create([
            'kode' => $request->kode,
            'nama_akun' => $request->nama_akun,
            'flag' => $request->flag ?? 1,
        ]);

        $jenisFileOperator = $request->input('jenisFileOp');
        $jenisFileKeuangan = $request->input('jenisFileKeu');
        $akunBelanja->jenisFileOperator()->attach($jenisFileOperator);
        $akunBelanja->jenisFileKeuangan()->attach($jenisFileKeuangan);
        return redirect()->route('manage.mak.akun')->with('success', 'Akun berhasil ditambahkan.');
    }

    public function editAkun($id)
    {
        $formPengajuan = FormPengajuan::all();
        $accounts = AkunBelanja::findOrFail($id);
        $jenisFileOperator = JenisFileOperator::visible()->get();
        $jenisFileKeuangan = JenisFileKeuangan::visible()->get();
    
        // $jenisFileOperator = $accounts->jenisFileOperator()
        //                               ->select('jenis_file_operator.id as id', 'nama_file')
        //                               ->get()
        //                               ->toArray();
    
        // $jenisFileKeuangan = $accounts->jenisFileKeuangan()
        //                               ->select('jenis_file_keuangan.id as id', 'nama_file')
        //                               ->get()
        //                               ->toArray();
    
        $jenisFileOperatorSelected = $accounts->jenisFileOperator()->pluck('jenis_file_operator.id as id')->toArray();
        $jenisFileKeuanganSelected = $accounts->jenisFileKeuangan()->pluck('jenis_file_keuangan.id as id')->toArray();
    
        return view('manage.mak.akun.edit', [
            'account' => $accounts,
            'jenisFileOperator' => $jenisFileOperator,
            'jenisFileKeuangan' => $jenisFileKeuangan,
            'formPengajuan' => $formPengajuan,
            'jenisFileOperatorSelected' => $jenisFileOperatorSelected,
            'jenisFileKeuanganSelected' => $jenisFileKeuanganSelected
        ]);
    }
    

    public function update(Request $request, $id)
    {
        $akunBelanja = AkunBelanja::findOrFail($id);

        $request->validate([
            'kode' => 'required|string|max:6',
            'nama_akun' => 'required|string|max:100',
        ]);

        $data = [
            'kode' => $request->kode,
            'nama_akun' => $request->nama_akun,
            'flag' => $request->flag ?? 1,
        ];

        $akunBelanja ->update($data);

        $jenisFileOperator = $request->input('jenisFileOp');
        $jenisFileKeuangan = $request->input('jenisFileKeu');
        $akunBelanja->jenisFileOperator()->sync($jenisFileOperator); // Sync otomatis menambahkan dan menghapus
        $akunBelanja->jenisFileKeuangan()->sync($jenisFileKeuangan);
        return redirect()->route('manage.mak.akun')->with('success', 'Akun belanja berhasil diedit.');
    }

    // Controller Komponen
    public function komponen()
    {
        $formPengajuan = FormPengajuan::all();
        $components = Komponen::all();
        return view('manage.mak.komponen.index', [
            'components' => $components,
            'formPengajuan' => $formPengajuan
        ]);
    }

    public function createKomponen()
    {
        $formPengajuan = FormPengajuan::all();
        return view('manage.mak.komponen.create', [
            'formPengajuan' => $formPengajuan
        ]);
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
        $formPengajuan = FormPengajuan::all();
        $subcomponents = SubKomponen::all();
        return view('manage.mak.subkomponen.index', [
            'subcomponents' => $subcomponents,
            'formPengajuan' => $formPengajuan
        ]);
    }

    public function createSubKomponen()
    {
        $formPengajuan = FormPengajuan::all();
        return view('manage.mak.subkomponen.create', [
            'formPengajuan' => $formPengajuan
        ]);
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
        $formPengajuan = FormPengajuan::all();
        $kegiatans = Kegiatan::all();
        return view('manage.mak.kegiatan.index', [
            'kegiatans' => $kegiatans,
            'formPengajuan' => $formPengajuan
        ]);
    }

    public function createKegiatan()
    {
        $formPengajuan = FormPengajuan::all();
        return view('manage.mak.kegiatan.create', [
            'formPengajuan' => $formPengajuan
        ]);
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
        $formPengajuan = FormPengajuan::all();
        $kros = KRO::all();
        return view('manage.mak.kro.index', [
            'kros' => $kros,
            'formPengajuan' => $formPengajuan
        ]);
    }

    public function createKro()
    {
        $formPengajuan = FormPengajuan::all();
        return view('manage.mak.kro.create', [
            'formPengajuan' => $formPengajuan
        ]);
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
        $formPengajuan = FormPengajuan::all();
        $outputs = Output::all();
        return view('manage.mak.output.index', [
            'outputs' => $outputs,
            'formPengajuan' => $formPengajuan
        ]);
    }

    public function createOutput()
    {
        $formPengajuan = FormPengajuan::all();
        $kegiatans = Kegiatan::where('flag', 1)->get();
        $kros = Kro::where('flag', 1)->get();

        return view('manage.mak.output.create', compact('kegiatans', 'kros', 'formPengajuan'));
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
            'flag' => $request->flag ?? 1,
        ]);

        return redirect()->route('manage.mak.output')->with('success', 'Output berhasil ditambahkan.');
    }

    // Controller Jenis file operator
    public function JenisFileOperator()
    {
        $formPengajuan = FormPengajuan::all();
        $jenis_file_operators = JenisFileOperator::all();
        return view('manage.mak.jenis_file_operator.index', [
            'jenis_file_operators' => $jenis_file_operators,
            'formPengajuan' => $formPengajuan
        ]);
    }

    public function createJenisFileOperator()
    {
        $formPengajuan = FormPengajuan::all();
        return view('manage.mak.jenis_file_operator.create', [
            'formPengajuan' => $formPengajuan
        ]);
    }
    
    public function storeJenisFileOperator(Request $request)
    {
        $request->validate([
            'jenis_file_operator' => 'required|string|max:255',
        ]);

        JenisFileOperator::create([
            'jenis_file_operator' => $request->jenis_file_operator,
            'flag' => $request->flag ?? 1,
        ]);

        return redirect()->route('manage.mak.jenis_file_operator')->with('success', 'Jenis file operator berhasil ditambahkan.');
    }

    // Controller Jenis file keuangan
    public function JenisFileKeuangan()
    {
        $formPengajuan = FormPengajuan::all();
        $jenis_file_keuangans = JenisFileKeuangan::all();
        return view('manage.mak.jenis_file_keuangan.index', [
            'jenis_file_keuangans' => $jenis_file_keuangans,
            'formPengajuan' => $formPengajuan
        ]);
    }

    public function createJenisFileKeuangan()
    {
        $formPengajuan = FormPengajuan::all();
        return view('manage.mak.jenis_file_keuangan.create', [
            'formPengajuan' => $formPengajuan
        ]);
    }
    
    public function storeJenisFileKeuangan(Request $request)
    {
        $request->validate([
            'jenis_file_keuangan' => 'required|string|max:255',
        ]);

        JenisFileKeuangan::create([
            'jenis_file_keuangan' => $request->jenis_file_keuangan,
            'flag' => $request->flag ?? 1,
        ]);

        return redirect()->route('manage.mak.jenis_file_keuangan')->with('success', 'Jenis file keuangan berhasil ditambahkan.');
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

    public function updateFlagJenisFileOperator(Request $request, $id)
    {
        $request->validate([
            'flag' => 'required|boolean',
        ]);

        $jenis_file_operator = JenisFileOperator::findOrFail($id);
        $jenis_file_operator->flag = $request->flag;
        $jenis_file_operator->save();

        return redirect()->back()->with('success', 'Flag Jenis File Operator berhasil diperbarui.');
    }

    public function updateFlagJenisFileKeuangan(Request $request, $id)
    {
        $request->validate([
            'flag' => 'required|boolean',
        ]);

        $jenis_file_keuangan = JenisFileKeuangan::findOrFail($id);
        $jenis_file_keuangan->flag = $request->flag;
        $jenis_file_keuangan->save();

        return redirect()->back()->with('success', 'Flag Jenis File Keuangan berhasil diperbarui.');
    }


}
