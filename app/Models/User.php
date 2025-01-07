<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nip_lama',
        'username',
        'password',
        'email',
        'id_role',
        'photo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function nipLama()
    {
        return $this->belongsTo(Pegawai::class, 'nip_lama', 'nip_lama');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role', 'id');
    }

    public function formPengajuan()
    {
        return $this->hasMany(FormPengajuan::class, 'nip_pengaju', 'nip_lama');
    }

    public function fileUploadOperator()
    {
        return $this->hasMany(FileUploadOperator::class, 'nip_pengaju', 'nip_lama');
    }

    public function fileUploadKeuangan()
    {
        return $this->hasMany(FileUploadKeuangan::class, 'nip_pengawas', 'nip_lama');
    }
}
