<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KunjunganToko extends Model
{
    use HasFactory;

    protected $table = 'kunjungan_toko';
    protected $primaryKey = 'id_kunjungan_toko';
    public $timestamps = false; // jika tidak menggunakan timestamps
    protected $fillable = [
        'id_daftar_toko',
        'tanggal',
        'sisa_produk',
        'gambar',
    ];
}
