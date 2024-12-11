<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = 'kegiatan';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'kode',
        'kegiatan',
        'flag',
    ];

    public function scopeVisible($query)
    {
        return $query->where('flag', 1);
    }

    public function outputs()
    {
        return $this->hasMany(Output::class, 'kegiatan', 'kode');
    }
}
