<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarToko extends Model
{
    use HasFactory;

    //MENAMBAHKAN RELASI TOKO DAN KUNJUNGANTOKO (EDIT BY JUN)
    public function kunjunganToko()
    {
        return $this->hasMany(KunjunganToko::class, 'id_daftar_toko');
    }

    protected $table = 'daftar_toko';

    protected $primaryKey = 'id_daftar_toko';

    public $incrementing = true;

    protected $fillable = [
        'nama_toko',
        'lokasi',
        'nama_pemilik',
        'no_telp',
    ];
    public $timestamps = false; // Menonaktifkan timestamp otomatis
}