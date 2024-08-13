<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarToko extends Model
{
    use HasFactory;

    protected $table = 'daftar_toko';

    protected $primaryKey = 'id_daftar_toko';

    public $incrementing = true;

    protected $fillable = [
        'nama_toko',
        'lokasi',
        'nama_pemilik',
        'no_telp',
    ];
}