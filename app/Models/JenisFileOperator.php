<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisFileOperator extends Model
{
    use HasFactory;

    protected $table = 'jenis_file_operator';
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

    public function akunFileOperator()
    {
        return $this->hasMany(AkunFileOperator::class, 'id_jenis_file_operator');
    }

    public function akunBelanja()
    {
        return $this->belongsToMany(AkunBelanja::class, 'akun_file_operator', 'id_jenis_file_operator', 'id_akun_belanja');
    }
}
