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
        'kegiatan',
        'kode_kro',
        'kode_ro',
        'kode_output',
        'flag'
    ];

    public function scopeVisible($query)
    {
        return $query->where('flag', 1);
    }

    // Relasi ke Kegiatan, KRO, RO (many-to-one)
    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'kode_kegiatan', 'kode');
    }

    public function kro()
    {
        return $this->belongsTo(KRO::class, 'kode_kro', 'kode');
    }

    public function ro()
    {
        return $this->belongsTo(RO::class, 'kode_ro', 'kode');
    }

    // Relasi ke FormPengajuan (one-to-many)
    public function formPengajuans()
    {
        return $this->hasMany(FormPengajuan::class, 'id_output', 'id');
    }
}
