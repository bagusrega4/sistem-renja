<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AkunBelanja extends Model
{
    use HasFactory;

    // Menentukan tabel yang terkait
    protected $table = 'akun_belanja';

    // Menentukan primary key (jika bukan id default Laravel)
    protected $primaryKey = 'id';

    // Menentukan apakah primary key auto increment
    public $incrementing = true;

    // Menentukan tipe data primary key
    protected $keyType = 'int';

    // Menentukan kolom yang dapat diisi secara massal
    protected $fillable = [
        'kode',
        'akun_belanja',
        'flag',
    ];

    // Menentukan apakah menggunakan timestamps
    public $timestamps = false;

    public function formPengajuans()
    {
        return $this->hasMany(FormPengajuan::class, 'kode_akun', 'kode');
    }

}
