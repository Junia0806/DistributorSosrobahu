<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangAgen extends Model
{
    use HasFactory;

    protected $table = 'tbl_barang_agen';
    
    protected $primaryKey = 'id_barang_agen';

    protected $fillable = [
        'id_master_barang',
        'id_user_agen',
        'harga_agen',
        'stok_karton',
    ];
}
