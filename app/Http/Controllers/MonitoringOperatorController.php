<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormPengajuan;
use App\Models\AkunBelanja;
use App\Models\Pegawai;
use App\Models\FileUploadOperator;
use App\Models\FileUploadKeuangan;
use App\Models\AkunFileOperator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class MonitoringOperatorController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $filters = $request->input('filters');
            $nipPengaju = auth()->user()->nip_lama;

            if ($filters) {
                $pengajuan = FormPengajuan::with(['statusPengajuan'])
                    ->whereIn('id_akun_belanja', $filters)->where('nip_pengaju', $nipPengaju)
                    ->get();
            } else {
                $pengajuan = FormPengajuan::with(['statusPengajuan'])
                    ->where('nip_pengaju', $nipPengaju)
                    ->get();
                foreach ($pengajuan as $p) {
                    $pegawai = Pegawai::where('nip_lama', $p->nip_pengaju)->first();
                }
            }

            $formPengajuan = FormPengajuan::all();
            $akunBelanja = AkunBelanja::all();

            $counter = 1;

            $data = view('partials._tbody_monitoring_operator', compact('pengajuan', 'counter'))->render();

            return response()->json([
                'html' => $data,
            ]);
        } else {
            $nipPengaju = auth()->user()->nip_lama;
            $akunBelanja = AkunBelanja::all();
            $formPengajuan = FormPengajuan::all();

            $pengajuan = FormPengajuan::with(['statusPengajuan'])
                ->where('nip_pengaju', $nipPengaju)
                ->get();
            foreach ($pengajuan as $p) {
                $pegawai = Pegawai::where('nip_lama', $p->nip_pengaju)->first();
            }

            return view('monitoring.operator.index', compact('formPengajuan', 'akunBelanja', 'pengajuan'));
        }
    }

    public function upload($id)
    {
        $formPengajuan = FormPengajuan::all();

        $nipPengaju = auth()->user()->nip_lama;

        $fp = FormPengajuan::with(['akunBelanja.jenisFileOperator'])
            ->where('id', $id)
            ->where('nip_pengaju', $nipPengaju)
            ->first();

        if (!$fp) {
            return redirect()->back()->with('error', 'Form pengajuan tidak ditemukan atau Anda tidak memiliki akses.');
        }

        $jenisFilesOperator = $fp->akunBelanja->jenisFileOperator;

        return view('monitoring.operator.upload', compact('fp', 'jenisFilesOperator', 'formPengajuan'));
    }

    public function store(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $formPengajuan = FormPengajuan::with(['akunBelanja.jenisFileOperator'])->find($id);

            if (!$formPengajuan) {
                return redirect()->back()->with('error', 'Form pengajuan tidak ditemukan.');
            }

            $akunBelanja = $formPengajuan->akunBelanja;
            $jenisFilesOperator = $akunBelanja->jenisFileOperator;

            $rules = [];
            $messages = [];

            foreach ($jenisFilesOperator as $jenisFileOperator) {
                $fileKey = str_replace(' ', '_', $jenisFileOperator->nama_file);
                $rules[$fileKey] = 'required|file|mimes:jpeg,jpg,png,pdf,doc,docx,xls,xlsx|max:4096';
                $messages["{$fileKey}.required"] = "File {$jenisFileOperator->nama_file} wajib diupload.";
                $messages["{$fileKey}.mimes"] = "File {$jenisFileOperator->nama_file} harus berformat jpeg, jpg, png, pdf, doc, docx, xls, atau xlsx.";
                $messages["{$fileKey}.max"] = "Ukuran file {$jenisFileOperator->nama_file} maksimal 4MB.";
            }

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            foreach ($jenisFilesOperator as $jenisFileOperator) {
                $fileKey = str_replace(' ', '_', $jenisFileOperator->nama_file);

                try {
                    if ($request->hasFile($fileKey)) {
                        $akunFileOperator = AkunFileOperator::where('id_akun_belanja', $akunBelanja->id)
                            ->where('id_jenis_file_operator', $jenisFileOperator->id)
                            ->first();

                        if (!$akunFileOperator) {
                            return redirect()->back()->with('error', "Akun file untuk {$jenisFileOperator->nama_file} tidak ditemukan. Silakan hubungi admin.");
                        }

                        $file = $request->file($fileKey);

                        if (!$file->isValid()) {
                            throw new \Exception("File {$fileKey} upload failed: " . $file->getErrorMessage());
                        }

                        $path = $file->store('uploads/file_operator', 'public');

                        if (!$path) {
                            throw new \Exception("Failed to store file {$fileKey}");
                        }

                        $existingFileUpload = FileUploadOperator::where('id_form_pengajuan', $formPengajuan->id)
                            ->where('id_akun_file_operator', $akunFileOperator->id)
                            ->where('nip_pengaju', auth()->user()->nip_lama)
                            ->first();

                        if ($existingFileUpload) {
                            Storage::disk('public')->delete($existingFileUpload->file);
                            $existingFileUpload->update(['file' => $path]);
                        } else {
                            FileUploadOperator::create([
                                'id_form_pengajuan' => $formPengajuan->id,
                                'id_akun_file_operator' => $akunFileOperator->id,
                                'nip_pengaju' => auth()->user()->nip_lama,
                                'file' => $path,
                            ]);
                        }
                    }
                } catch (\Exception $e) {
                    DB::rollBack();
                    return redirect()->back()->with('error', "Gagal mengupload file {$jenisFileOperator->nama_file}: " . $e->getMessage());
                }
            }

            if ($formPengajuan->id_status == 1 || $formPengajuan->id_status == 3) {
                $formPengajuan->id_status = 2;
                $formPengajuan->save();
            }

            DB::commit();

            return redirect()->route('monitoring.operator.index')->with('success', 'File operator berhasil diupload.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', "Gagal mengupload file: " . $e->getMessage());
        }
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
