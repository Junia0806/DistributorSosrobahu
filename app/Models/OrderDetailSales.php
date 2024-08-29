<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetailSales extends Model
{
    use HasFactory;

    // Tentukan nama tabel yang terkait dengan model ini
    protected $table = 'order_detail_sales';

    // Tentukan primary key tabel jika tidak menggunakan default 'id'
    protected $primaryKey = 'id_detail_sales';

    // Jika primary key bukan auto increment
    public $incrementing = true;

    // Jika primary key bukan integer
    protected $keyType = 'int';

    // Tentukan kolom-kolom yang dapat diisi massal
    protected $fillable = [
        'id_order',
        'id_user_agen',
        'id_user_sales',
        'id_master_barang',
        'id_barang_agen',
        'jumlah_produk',
        'jumlah_harga_item',
    ];

    // Tentukan kolom-kolom yang harus di-cast ke tipe data tertentu
    protected $casts = [
        'id_order' => 'integer',
        'id_user_agen' => 'integer',
        'id_user_sales' => 'integer',
        'id_master_barang' => 'integer',
        'id_barang_agen' => 'integer',
        'jumlah_produk' => 'integer',
        'jumlah_harga_item' => 'integer',
    ];

    // Menyediakan fungsi untuk relasi ke OrderSale
    public function orderSale()
    {
        return $this->belongsTo(OrderSale::class, 'id_order', 'id_order');
    }
}
