<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'nip_lama',
        'nip_baru',
        'jabatan',
        'kode_wilayah',
        'nama_wilayah',
        'golongan',
    ];

    public function formPengajuans()
    {
        return $this->hasMany(FormPengajuan::class, 'nip_pengaju', 'nip_baru');
    }
}
