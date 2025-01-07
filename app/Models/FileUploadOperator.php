<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileUploadOperator extends Model
{
    use HasFactory;

    protected $table = 'file_upload_operator';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = [
        'id_form_pengajuan',
        'id_akun_file_operator',
        'nip_pengaju',
        'file',
    ];

    public function formPengajuan()
    {
        return $this->belongsTo(FormPengajuan::class, 'id_form_pengajuan', 'id');
    }

    public function akunFileOperator()
    {
        return $this->belongsTo(AkunFileOperator::class, 'id_akun_file_operator', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'nip_pengaju', 'nip_lama');
    }
}
