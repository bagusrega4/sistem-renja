<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Output extends Model
{
    use HasFactory;

    protected $table = 'output';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'id_kegiatan',
        'id_kro',
        'kode_ro',
        'output',
        'flag'
    ];

    public function scopeVisible($query)
    {
        return $query->where('flag', 1);
    }

    // Relasi ke Kegiatan, KRO, RO (many-to-one)
    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'id_kegiatan', 'id');
    }

    public function kro()
    {
        return $this->belongsTo(KRO::class, 'id_kro', 'id');
    }

    // Relasi ke FormPengajuan (one-to-many)
    public function formPengajuan()
    {
        return $this->hasMany(FormPengajuan::class, 'id_output', 'id');
    }
}
