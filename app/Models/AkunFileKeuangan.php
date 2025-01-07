<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AkunFileKeuangan extends Model
{
    use HasFactory;

    protected $table = 'akun_file_keuangan';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'id_akun_belanja',
        'id_jenis_file_keuangan',
    ];

    public function akunBelanja()
    {
        return $this->belongsTo(AkunBelanja::class, 'id_akun_belanja', 'id');
    }

    public function jenisFileKeuangan()
    {
        return $this->belongsTo(JenisFileKeuangan::class, 'id_jenis_file_keuangan', 'id');
    }

    public function fileUploadKeuangan()
    {
        return $this->hasMany(FileUploadKeuangan::class, 'id_akun_file_keuangan', 'id');
    }
}
