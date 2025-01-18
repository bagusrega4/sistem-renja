<?php

namespace App\Http\Controllers;

use App\Models\FormPengajuan;
use App\Models\AkunFileKeuangan;
use App\Models\FileUploadOperator;
use App\Models\FileUploadKeuangan;
use App\Models\FormKeuangan;
use App\Models\AkunBelanja;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class MonitoringKeuanganController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $filters = $request->input('filters');

            if ($filters) {
                $pengajuan = FormPengajuan::whereIn('id_akun_belanja', $filters)->where('id_status', '!=', 1)->get();
            } else {
                $pengajuan = FormPengajuan::where('id_status', '!=', 1)->get();
            }
            $formPengajuan = FormPengajuan::all();
            $akunBelanja = AkunBelanja::all();

            $pegawaiData = [];
            foreach ($pengajuan as $p) {
                $pegawai = Pegawai::where('nip_lama', $p->nip_pengaju)->first();
                $pegawaiData[$p->id] = $pegawai;
            }
            $counter = 1;

            $data = view('partials._tbody_pengajuan_with_status', compact('pengajuan', 'counter'))->render();

            return response()->json([
                'html' => $data,
            ]);
        } else {
            $formPengajuan = FormPengajuan::all();
            $akunBelanja = AkunBelanja::all();
            $pengajuan = FormPengajuan::where('id_status', '!=', 1)->get();
            foreach ($pengajuan as $p) {
                $pegawai = Pegawai::where('nip_lama', $p->nip_pengaju)->first();
            }
            return view('monitoring.keuangan.index', ['pengajuan' => $pengajuan, 'pegawai' => $pegawai, 'formPengajuan' => $formPengajuan, 'akunBelanja' => $akunBelanja]);
        }
    }

    public function viewFile($id)
    {
        $formPengajuan = FormPengajuan::all();

        $pengajuan = FormPengajuan::with(['akunBelanja.jenisFileOperator'])->find($id);

        if (!$pengajuan) {
            return redirect()->back()->with('error', 'Form pengajuan tidak ditemukan.');
        }

        $pegawai = Pegawai::where('nip_lama', $pengajuan->nip_pengaju)->first();

        $fileUploadOperators = FileUploadOperator::where('id_form_pengajuan', $id)
            ->where('nip_pengaju', $pengajuan->nip_pengaju)
            ->with('akunFileOperator.jenisFileOperator')
            ->get();

        $uploadedFiles = $fileUploadOperators->mapWithKeys(function ($file) {
            return [$file->akunFileOperator->jenisFileOperator->id => $file];
        });

        $jenisFileOperators = $pengajuan->akunBelanja->jenisFileOperator;

        $uploadedJenisFiles = $jenisFileOperators->filter(function ($jenisFile) use ($uploadedFiles) {
            return $uploadedFiles->has($jenisFile->id);
        });

        return view('monitoring.keuangan.file', [
            'pengajuan' => $pengajuan,
            'pegawai' => $pegawai,
            'uploadedJenisFiles' => $uploadedJenisFiles,
            'uploadedFiles' => $uploadedFiles,
            'formPengajuan' => $formPengajuan
        ]);
    }

    public function upload($id)
    {
        // Cari form pengajuan berdasarkan ID
        $fp = FormPengajuan::with(['akunBelanja.jenisFileKeuangan'])->find($id);

        // Validasi jika form pengajuan tidak ditemukan atau memiliki status tertentu
        if (!$fp || in_array($fp->id_status, [1, 2, 3])) {
            return view('error.unauthorized');
        }

        // Ambil jenis file keuangan terkait akun belanja
        $jenisFilesKeuangan = $fp->akunBelanja->jenisFileKeuangan ?? [];

        // Validasi berdasarkan jenis pembayaran
        if (request()->isMethod('post')) {
            $data = request()->validate([
                'jenis_pembayaran' => 'required|string',
                'no_spby' => request('jenis_pembayaran') !== 'LS' ? 'required|string' : 'nullable',
                'no_drpp' => request('jenis_pembayaran') !== 'LS' ? 'required|string' : 'nullable',
                'tanggal_drpp' => request('jenis_pembayaran') !== 'LS' ? 'required|date' : 'nullable',
                'no_spm' => 'required|string',
                'tanggal_spm' => 'required|date',
                // Tambahkan validasi file dinamis
                // ...
            ]);

            // Set nilai default untuk field yang tidak relevan (jika jenis pembayaran LS)
            if ($data['jenis_pembayaran'] === 'LS') {
                $data['no_spby'] = '-';
                $data['no_drpp'] = '-';
                $data['tanggal_drpp'] = '1970-01-01';
            }

            // Simpan data ke database atau lakukan tindakan lain yang diperlukan
            // ...
            return redirect()->route('monitoring.keuangan.index')->with('success', 'Data berhasil disimpan.');
        }

        // Tampilkan view upload dengan data yang relevan
        $formPengajuan = FormPengajuan::all();
        return view('monitoring.keuangan.upload', compact('fp', 'jenisFilesKeuangan', 'formPengajuan'));
    }


    public function store(Request $request, $id)
    {
        $formPengajuan = FormPengajuan::find($id);

        if (!$formPengajuan || $formPengajuan->id_status == 1 || $formPengajuan->id_status == 2 || $formPengajuan->id_status == 3) {
            return view('error.unauthorized');
        }

        DB::beginTransaction();

        try {
            $formPengajuan = FormPengajuan::with(['akunBelanja.jenisFileKeuangan'])->find($id);

            if (!$formPengajuan) {
                return redirect()->back()->with('error', 'Form pengajuan tidak ditemukan.');
            }

            $akunBelanja = $formPengajuan->akunBelanja;
            $jenisFilesKeuangan = $akunBelanja->jenisFileKeuangan;

            $rules = [
                'no_spby' => 'required|string|max:50',
                'no_drpp' => 'required|string|max:50',
                'no_spm' => 'required|string|max:50',
                'tanggal_drpp' => 'required|date',
                'tanggal_spm' => 'required|date',
            ];

            $messages = [
                'no_spby.required' => 'No. SPBy wajib diisi.',
                'no_drpp.required' => 'No. DRPP wajib diisi.',
                'no_spm.required' => 'No. SPM wajib diisi.',
                'tanggal_drpp.required' => 'Tanggal DRPP wajib diisi.',
                'tanggal_drpp.date' => 'Tanggal DRPP harus berupa tanggal yang valid.',
                'tanggal_spm.required' => 'Tanggal SPM wajib diisi.',
                'tanggal_spm.date' => 'Tanggal SPM harus berupa tanggal yang valid.',
            ];

            foreach ($jenisFilesKeuangan as $jenisFileKeuangan) {
                $fileKey = str_replace(' ', '_', $jenisFileKeuangan->nama_file);
                $rules[$fileKey] = 'required|file|mimes:jpeg,jpg,png,pdf,doc,docx,xls,xlsx|max:4096';
                $messages["{$fileKey}.required"] = "File {$jenisFileKeuangan->nama_file} wajib diupload.";
                $messages["{$fileKey}.mimes"] = "File {$jenisFileKeuangan->nama_file} harus berformat jpeg, jpg, png, pdf, doc, docx, xls, atau xlsx.";
                $messages["{$fileKey}.max"] = "Ukuran file {$jenisFileKeuangan->nama_file} maksimal 4MB.";
            }

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $formKeuangan = FormKeuangan::create([
                'id_form_pengajuan' => $formPengajuan->id,
                'nip_pengawas' => auth()->user()->nip_lama,
                'no_spby' => $request->input('no_spby'),
                'no_drpp' => $request->input('no_drpp'),
                'no_spm' => $request->input('no_spm'),
                'tanggal_drpp' => $request->input('tanggal_drpp'),
                'tanggal_spm' => $request->input('tanggal_spm'),
            ]);

            foreach ($jenisFilesKeuangan as $jenisFileKeuangan) {
                $fileKey = str_replace(' ', '_', $jenisFileKeuangan->nama_file);

                if ($request->hasFile($fileKey)) {
                    $file = $request->file($fileKey);

                    if (!$file->isValid()) {
                        throw new \Exception("File {$fileKey} upload failed: " . $file->getErrorMessage());
                    }

                    $path = $file->store('uploads/file_keuangan', 'public');
                    if (!$path) {
                        throw new \Exception("Failed to store file {$fileKey}");
                    }

                    $akunFileKeuangan = AkunFileKeuangan::where('id_akun_belanja', $akunBelanja->id)
                        ->where('id_jenis_file_keuangan', $jenisFileKeuangan->id)
                        ->first();

                    if (!$akunFileKeuangan) {
                        throw new \Exception("Akun file untuk {$jenisFileKeuangan->nama_file} tidak ditemukan. Silakan hubungi admin.");
                    }

                    $existingFileUpload = FileUploadKeuangan::where('id_form_pengajuan', $formPengajuan->id)
                        ->where('id_akun_file_keuangan', $akunFileKeuangan->id)
                        ->where('nip_pengawas', auth()->user()->nip_lama)
                        ->first();

                    if ($existingFileUpload) {
                        throw new \Exception("File {$jenisFileKeuangan->nama_file} sudah pernah diupload sebelumnya.");
                    }

                    FileUploadKeuangan::create([
                        'id_form_pengajuan' => $formPengajuan->id,
                        'id_akun_file_keuangan' => $akunFileKeuangan->id,
                        'nip_pengawas' => auth()->user()->nip_lama,
                        'file' => $path,
                    ]);
                }
            }

            if ($formPengajuan->id_status == 4) {
                $formPengajuan->id_status = 5;
                $formPengajuan->save();
            }

            DB::commit();

            return redirect()->route('monitoring.keuangan.index')->with('success', 'Form keuangan berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', "Gagal mengupload file: " . $e->getMessage());
        }
    }

    public function approve($id)
    {
        $pengajuan = FormPengajuan::find($id);

        if (!$pengajuan) {
            return redirect()->back()->with('error', 'Form pengajuan tidak ditemukan.');
        }

        if ($pengajuan->id_status != 1 && $pengajuan->id_status != 2) {
            return redirect()->back()->with('error', 'Form pengajuan tidak dapat diapprove pada status saat ini.');
        }

        $pengajuan->id_status = 4;

        $pengajuan->save();

        return redirect()->route('monitoring.keuangan.file', ['id' => $id])->with('success', 'Form pengajuan berhasil diapprove.');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'rejection_note' => 'required|string|max:1000',
        ]);

        $pengajuan = FormPengajuan::find($id);

        if (!$pengajuan) {
            return redirect()->back()->with('error', 'Form pengajuan tidak ditemukan.');
        }

        if ($pengajuan->id_status != 1 && $pengajuan->id_status != 2) {
            return redirect()->back()->with('error', 'Form pengajuan tidak dapat direject pada status saat ini.');
        }

        $pengajuan->id_status = 3;
        $pengajuan->rejection_note = $request->rejection_note;
        $pengajuan->save();

        return redirect()->route('monitoring.keuangan.file', ['id' => $id])->with('success', 'Form pengajuan berhasil ditolak.');
    }

    public function getBuktiTransfer($idFormPengajuan)
    {
        $buktiTransfer = FileUploadKeuangan::where('id_form_pengajuan', $idFormPengajuan)
            ->whereHas('akunFileKeuangan.jenisFileKeuangan', function ($query) {
                $query->where('id', 12); // ID 12 untuk jenis file "bukti transfer"
            })
            ->first();

        if (!$buktiTransfer) {
            return response()->json(['error' => 'Bukti transfer tidak ditemukan'], 404);
        }

        $filePath = $buktiTransfer->file;

        return response()->json([
            'file_path' => $filePath,
            'file_name' => basename($filePath),
        ]);
    }
}
