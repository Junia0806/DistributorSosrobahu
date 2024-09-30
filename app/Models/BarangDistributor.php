<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangDistributor extends Model
{
    use HasFactory;

    protected $table = 'tbl_barang_disitributor';
    
    protected $primaryKey = 'id_barang_distributor';

    protected $fillable = [
        'id_master_barang',
        'id_user_distributor',
        'harga_distributor',
        'stok_karton',
    ];
}
