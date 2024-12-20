<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileKeuangan extends Model
{
    use HasFactory;

    protected $table = 'file_keuangan';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'fileOperatorId',
        'noSPBy',
        'noDRPP',
        'noSPM',
        'tanggal_SPM',
        'tanggal_DRPP',
        'buktiTransfer',
        'spjHonorInnas',
        'sspHonorInnas',
        'fileLainya'
    ];

    public function fileOperator()
    {
        return $this->belongsTo(FileKeuangan::class, 'fileOperatorId', 'id');
    }
}
