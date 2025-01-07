<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormPengajuan extends Model
{
    use HasFactory;

    protected $table = 'form_pengajuan';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = [
        'no_fp',
        'id_output',
        'id_komponen',
        'id_subkomponen',
        'id_akun_belanja',
        'tanggal_mulai',
        'tanggal_akhir',
        'no_sk',
        'uraian',
        'nominal',
        'nip_pengaju',
        'id_status',
        'rejection_note',
    ];

    public function output()
    {
        return $this->belongsTo(Output::class, 'id_output', 'id');
    }

    public function komponen()
    {
        return $this->belongsTo(Komponen::class, 'id_komponen', 'id');
    }

    public function subKomponen()
    {
        return $this->belongsTo(SubKomponen::class, 'id_subkomponen', 'id');
    }

    public function akunBelanja()
    {
        return $this->belongsTo(AkunBelanja::class, 'id_akun_belanja', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'nip_pengaju', 'nip_lama');
    }

    public function pegawai()
    {
        return $this->hasOneThrough(
            Pegawai::class,   // Model akhir
            User::class,      // Model perantara
            'nip_lama',       // Foreign key di tabel users
            'nip_lama',       // Foreign key di tabel pegawai
            'nip_pengaju',    // Local key di tabel form_pengajuan
            'nip_lama'        // Local key di tabel users
        );
    }

    public function statusPengajuan()
    {
        return $this->belongsTo(StatusPengajuan::class, 'id_status', 'id');
    }

    public function fileUploadOperator()
    {
        return $this->hasMany(FileUploadOperator::class, 'id_form_pengajuan', 'id');
    }

    public function fileUploadKeuangan()
    {
        return $this->hasMany(FileUploadKeuangan::class, 'id_form_pengajuan', 'id');
    }

    public function formKeuangan()
    {
        return $this->hasOne(FormKeuangan::class, 'id_form_pengajuan', 'id');
    }

}
