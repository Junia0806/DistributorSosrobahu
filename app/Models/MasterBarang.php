<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterBarang extends Model
{
    use HasFactory;

    protected $table = 'master_barang';
    
    protected $primaryKey = 'id_master_barang';

    protected $fillable = [
        'nama_rokok',
        'harga_karton_pabrik',
        'stok_karton',
        'gambar',
        'stok_slop',
    ];
}


