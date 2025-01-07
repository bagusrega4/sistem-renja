<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisFileKeuangan extends Model
{
    use HasFactory;

    protected $table = 'jenis_file_keuangan';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = [
        'nama_file',
        'flag',
    ];

    public function scopeVisible($query)
    {
        return $query->where('flag', 1);
    }

    public function akunFileKeuangan()
    {
        return $this->hasMany(AkunFileKeuangan::class, 'id_jenis_file_keuangan');
    }

    public function akunBelanja()
    {
        return $this->belongsToMany(AkunBelanja::class, 'akun_file_keuangan', 'id_jenis_file_keuangan', 'id_akun_belanja');
    }
}
