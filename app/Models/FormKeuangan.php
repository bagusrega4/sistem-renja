<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormKeuangan extends Model
{
    use HasFactory;

    protected $table = 'form_keuangan';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = [
        'id_form_pengajuan',
        'nip_pengawas',
        'no_spby',
        'no_drpp',
        'no_spm',
        'tanggal_drpp',
        'tanggal_spm',
    ];

    public function formPengajuan()
    {
        return $this->belongsTo(FormPengajuan::class, 'id_form_pengajuan', 'id');
    }

}
