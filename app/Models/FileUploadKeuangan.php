<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileUploadKeuangan extends Model
{
    use HasFactory;

    protected $table = 'file_upload_keuangan';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = [
        'id_form_pengajuan',
        'id_akun_file_keuangan',
        'nip_pengawas',
        'file',
    ];

    public function formPengajuan()
    {
        return $this->belongsTo(FormPengajuan::class, 'id_form_pengajuan', 'id');
    }

    public function akunFileKeuangan()
    {
        return $this->belongsTo(AkunFileKeuangan::class, 'id_akun_file_keuangan', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'nip_pengawas', 'nip_lama');
    }
}
