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

    public function user()
    {
        return $this->belongsTo(User::class, 'nip_lama', 'nip_lama');
    }
}
