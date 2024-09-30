<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserSales extends Authenticatable
{
    use HasFactory;

    // Menentukan nama tabel yang digunakan model ini
    protected $table = 'user_sales';

    // Menentukan primary key dari tabel
    protected $primaryKey = 'id_user_sales';

    // Menentukan apakah primary key auto-incrementing
    public $incrementing = true;

    // Tipe data dari primary key
    protected $keyType = 'int';

    // Menentukan apakah menggunakan timestamp (created_at & updated_at)
    public $timestamps = true;

    // Mass assignable attributes
    protected $fillable = [
        'nama_lengkap',
        'username',
        'password',
        'no_telp',
        'status',
        'level',
        'gambar_ktp',
    ];

    // Hidden attributes (biasanya digunakan untuk menyembunyikan password)
    protected $hidden = [
        'password',
    ];

    // Jika password menggunakan hashing, tambahkan accessor dan mutator (opsional)
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function orderSales()
    {
        return $this->hasMany(OrderSale::class, 'id_user_sales');
    }
}
