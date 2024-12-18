<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileOperator extends Model
{
    use HasFactory;

    protected $table = 'file_operator';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'no_fp',
        'nama_permintaan',
        'kak_ttd',
        'surat_tugas',
        'sk_kpa',
        'laporan_innas',
        'daftar_hadir',
        'absen_harian',
        'rekap_norek_innas'
    ];

    public function formPengajuan()
    {
        return $this->belongsTo(FormPengajuan::class, 'no_fp', 'no_fp');
        return $this->belongsTo(FormPengajuan::class, 'uraian', 'nama_permintaan');
    }

}
