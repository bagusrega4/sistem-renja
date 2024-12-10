<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormPengajuan extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'formpengajuan';

    // Primary key
    protected $primaryKey = 'noFP';

    // Tipe primary key
    public $incrementing = true;
    protected $keyType = 'int';

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'id_output',
        'kode_komponen',
        'kode_subkomponen',
        'kode_akun',
        'tanggalMulai',
        'tanggalAkhir',
        'noSK',
        'uraian',
        'nominal',
        'nip_pengaju'
    ];

    // Nonaktifkan timestamps
    public $timestamps = false;

    // Relasi ke tabel Output (many-to-one)
    public function output()
    {
        return $this->belongsTo(Output::class, 'id_output', 'id');
    }

    // Relasi ke tabel Komponen (many-to-one)
    public function komponen()
    {
        return $this->belongsTo(Komponen::class, 'kode_komponen', 'kode');
    }

    // Relasi ke tabel SubKomponen (many-to-one)
    public function subKomponen()
    {
        return $this->belongsTo(SubKomponen::class, 'kode_subkomponen', 'kode');
    }

    // Relasi ke tabel Akun (many-to-one)
    public function akun()
    {
        return $this->belongsTo(AkunBelanja::class, 'kode_akun', 'kode');
    }

    // Relasi ke tabel Pegawai (many-to-one)
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'nip_pengaju', 'nipbaru');
    }
}
