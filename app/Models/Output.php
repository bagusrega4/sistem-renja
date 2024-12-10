<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Output extends Model
{
    use HasFactory;

    protected $table = 'output';

    // Menentukan primary key (jika bukan id default Laravel)
    protected $primaryKey = 'id';

    // Menentukan apakah primary key auto increment
    public $incrementing = true;

    // Menentukan tipe data primary key
    protected $keyType = 'int';

    protected $fillable = [
        'kegiatan',
        'kro',
        'ro',
        'output',
        'flag'
    ];

    public $timestamps = false;

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'kegiatan', 'kode');
    }

    public function kro()
    {
        return $this->belongsTo(KRO::class, 'kro', 'kode');
    }

    public function ro()
    {
        return $this->belongsTo(RO::class, 'ro', 'kode');
    }

    // Relasi ke FormPengajuan (one-to-many)
    public function formPengajuans()
    {
        return $this->hasMany(FormPengajuan::class, 'id_output', 'id');
    }
}
