<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AkunFileOperator extends Model
{
    use HasFactory;

    protected $table = 'akun_file_operator';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'id_akun_belanja',
        'id_jenis_file_operator',
    ];

    public function akunBelanja()
    {
        return $this->belongsTo(AkunBelanja::class, 'id_akun_belanja', 'id');
    }

    public function jenisFileOperator()
    {
        return $this->belongsTo(JenisFileOperator::class, 'id_jenis_file_operator', 'id');
    }

    public function fileUploadOperator()
    {
        return $this->hasMany(FileUploadOperator::class, 'id_akun_file_operator', 'id');
    }
}
