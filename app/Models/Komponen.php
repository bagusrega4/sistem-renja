<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komponen extends Model
{
    use HasFactory;

    protected $table = 'komponen';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'kode',
        'komponen',
        'flag',
    ];

    public function scopeVisible($query)
    {
        return $query->where('flag', 1);
    }

    public function formPengajuans()
    {
        return $this->hasMany(FormPengajuan::class, 'kode_komponen', 'kode');
    }
}
