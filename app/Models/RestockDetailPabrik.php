<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestockDetailPabrik extends Model
{
    use HasFactory;

    // Tentukan nama tabel yang terkait dengan model ini
    protected $table = 'restock_detail_pabrik';

    // Tentukan primary key tabel jika tidak menggunakan default 'id'
    protected $primaryKey = 'id_detail_pabrik';

    // Jika primary key bukan auto increment
    public $incrementing = true;

    // Jika primary key bukan integer
    protected $keyType = 'int';

    // Kolom yang dapat diisi
    protected $fillable = [
        'id_restock',
        'id_user_pabrik',
        'id_master_barang',
        'jumlah_produk',
    ];

    // Tentukan kolom-kolom yang harus di-cast ke tipe data tertentu
    protected $casts = [
        'id_restock' => 'integer',
        'id_user_pabrik' => 'integer',
        'id_master_barang' => 'integer',
        'jumlah_produk' => 'integer',
    ];

    // Relasi ke model OrderDistributor
    public function restockPabrik()
    {
        return $this->belongsTo(RestockPabrik::class, 'id_restock', 'id_restock');
    }
}
