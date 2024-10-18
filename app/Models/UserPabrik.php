<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserPabrik extends Authenticatable
{
    use HasFactory;

    // Nama tabel yang digunakan oleh model
    protected $table = 'user_pabrik';

    // Primary key tabel
    protected $primaryKey = 'id_user_pabrik';

    // Tipe primary key jika bukan increment (seperti UUID atau lainnya)
    public $incrementing = true;

    // Tipe primary key (integer, string, etc)
    protected $keyType = 'integer';

    // Kolom-kolom yang bisa diisi (mass assignable)
    protected $fillable = [
        'nama_lengkap',
        'username',
        'password',
        'no_telp',
        'status',
        'level',
        'nama_bank',
        'no_rek',
    ];

    // Kolom yang tidak ingin ditampilkan atau diproses
    protected $hidden = [
        'password',
    ];

    // Jika kolom timestamp tidak digunakan
    public $timestamps = true;

    // Mutator untuk mengenkripsi password secara otomatis
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    // Relasi ke model OrderDistributor
    public function restockPabrik()
    {
        return $this->hasMany(RestockPabrik::class, 'id_user_distributor');
    }
}
