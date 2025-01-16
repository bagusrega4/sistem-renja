<?php

namespace App\Http\Controllers;

use App\Models\FormPengajuan;
use App\Models\AkunFileKeuangan;
use App\Models\FileUploadOperator;
use App\Models\FileUploadKeuangan;
use App\Models\FormKeuangan;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class MonitoringKeuanganController extends Controller
{
    public function index()
    {
        $pengajuan = FormPengajuan::where('id_status', '!=', 1)->get();
        foreach ($pengajuan as $p) {
            $pegawai = Pegawai::where('nip_lama', $p->nip_pengaju)->first();
        }
        return view('monitoring.keuangan.index', ['pengajuan' => $pengajuan, 'pegawai' => $pegawai]);
    }
    public function viewFile($id)
    {
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
            'uploadedFiles' => $uploadedFiles
        ]);
    }


    public function upload($id)
    {
        $fp = FormPengajuan::find($id);

        if (!$fp || $fp->id_status == 1 || $fp->id_status == 2 || $fp->id_status == 3) {
            return view('error.unauthorized');
        }

        $formPengajuan = FormPengajuan::with(['akunBelanja.jenisFileKeuangan'])->find($id);

        if (!$formPengajuan) {
            return redirect()->back()->with('error', 'Form pengajuan tidak ditemukan.');
        }

        $jenisFilesKeuangan = $formPengajuan->akunBelanja->jenisFileKeuangan;

        return view('monitoring.keuangan.upload', compact('formPengajuan', 'jenisFilesKeuangan'));
    }

    public function store(Request $request, $id)
    {
        $fp = FormPengajuan::find($id);

        if (!$fp || $fp->id_status != 1 || $fp->id_status == 2 || $fp->id_status == 3) {
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
