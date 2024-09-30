<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetailDistributor extends Model
{
    use HasFactory;

    // Tentukan nama tabel yang terkait dengan model ini
    protected $table = 'order_detail_distributor';

    // Tentukan primary key tabel jika tidak menggunakan default 'id'
    protected $primaryKey = 'id_detail_distributor';

    // Jika primary key bukan auto increment
    public $incrementing = true;

    // Jika primary key bukan integer
    protected $keyType = 'int';

    // Kolom yang dapat diisi
    protected $fillable = [
        'id_order',
        'id_user_distributor',
        'id_master_barang',
        'jumlah_produk',
        'jumlah_harga_item',
    ];

    // Tentukan kolom-kolom yang harus di-cast ke tipe data tertentu
    protected $casts = [
        'id_order' => 'integer',
        'id_user_distributor' => 'integer',
        'id_master_barang' => 'integer',
        'jumlah_produk' => 'integer',
        'jumlah_harga_item' => 'integer',
    ];

    // Relasi ke model OrderDistributor
    public function orderDistributor()
    {
        return $this->belongsTo(OrderDistributor::class, 'id_order', 'id_order');
    }
}
