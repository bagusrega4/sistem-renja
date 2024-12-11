<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KRO extends Model
{
    use HasFactory;

    protected $table = 'kro';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'kode',
        'kro',
        'flag',
    ];

    public function scopeVisible($query)
    {
        return $query->where('flag', 1);
    }

    public function outputs()
    {
        return $this->hasMany(Output::class, 'kro', 'kode');
    }
}
