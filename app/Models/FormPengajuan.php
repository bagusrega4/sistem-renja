<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormPengajuan extends Model
{
    use HasFactory;

    protected $table = 'form_pengajuan';
    protected $primaryKey = 'no_fp';
    public $incrementing = false;
    protected $keyType = 'string';
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
        'nip_pengaju',
        'status',
        'rejection_note'
    ];

    protected $casts = [
        'status' => Status::class,
    ];

    public function output()
    {
        return $this->belongsTo(Output::class, 'id_output', 'id');
    }

    public function komponen()
    {
        return $this->belongsTo(Komponen::class, 'kode_komponen', 'kode');
    }

    public function subKomponen()
    {
        return $this->belongsTo(SubKomponen::class, 'kode_subkomponen', 'kode');
    }

    public function akunBelanja()
    {
        return $this->belongsTo(AkunBelanja::class, 'kode_akun', 'kode');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'nip_pengaju', 'nip_lama');
    }

    public function fileOperator()
    {
        return $this->hasOne(FileOperator::class, 'no_fp', 'no_fp');
    }
}
