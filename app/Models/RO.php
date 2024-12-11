<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RO extends Model
{
    use HasFactory;

    protected $table = 'ro';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'kode',
        'ro',
        'flag',
    ];

    public function scopeVisible($query)
    {
        return $query->where('flag', 1);
    }

    public function outputs()
    {
        return $this->hasMany(Output::class, 'ro', 'kode');
    }
}
