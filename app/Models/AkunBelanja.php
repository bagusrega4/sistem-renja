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
        'akun_belanja',
        'flag',
    ];

    public function scopeVisible($query)
    {
        return $query->where('flag', 1);
    }

    public function formPengajuans()
    {
        return $this->hasMany(FormPengajuan::class, 'kode_akun', 'kode');
    }
}
