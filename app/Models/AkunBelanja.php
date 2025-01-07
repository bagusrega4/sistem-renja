<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AkunBelanja extends Model
{
    use HasFactory;

    protected $table = 'akun_belanja';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'kode',
        'nama_akun',
        'flag',
    ];

    public function scopeVisible($query)
    {
        return $query->where('flag', 1);
    }

    public function formPengajuan()
    {
        return $this->hasMany(FormPengajuan::class, 'id_akun_belanja', 'id');
    }

    public function akunFileOperator()
    {
        return $this->hasMany(AkunFileOperator::class, 'id_akun_belanja', 'id');
    }

    public function akunFileKeuangan()
    {
        return $this->hasMany(AkunFileKeuangan::class, 'id_akun_belanja', 'id');
    }

    public function jenisFileOperator()
    {
        return $this->belongsToMany(JenisFileOperator::class, 'akun_file_operator', 'id_akun_belanja', 'id_jenis_file_operator');
    }

    public function jenisFileKeuangan()
    {
        return $this->belongsToMany(JenisFileKeuangan::class, 'akun_file_keuangan', 'id_akun_belanja', 'id_jenis_file_keuangan');
    }
}
