<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormPengajuan extends Model
{
    use HasFactory;

    protected $table = 'form_pengajuan';
    protected $primaryKey = 'no_fp';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'id_output',
        'kode_komponen',
        'kode_subkomponen',
        'kode_akun',
        'tanggal_mulai',
        'tangga_akhir',
        'no_sk',
        'uraian',
        'nominal',
        'nip_pengaju'
    ];

    public function output()
    {
        return $this->belongsTo(Output::class, 'id_output', 'id');
    }

    // Relasi ke tabel Komponen, SubKomponen, AkunBelanja, Pegawai (many-to-one)
    public function komponen()
    {
        return $this->belongsTo(Komponen::class, 'kode_komponen', 'kode');
    }

    public function subKomponen()
    {
        return $this->belongsTo(SubKomponen::class, 'kode_subkomponen', 'kode');
    }

    public function akun()
    {
        return $this->belongsTo(AkunBelanja::class, 'kode_akun', 'kode');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'nip_pengaju', 'nip_lama');
    }
}
