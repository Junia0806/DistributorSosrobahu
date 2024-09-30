<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDistributor extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan model
    protected $table = 'order_distributor';

    // Primary key dari tabel
    protected $primaryKey = 'id_order';

    // Mengatur timestamps (created_at dan updated_at)
    public $timestamps = true;

    // Kolom yang dapat diisi
    protected $fillable = [
        'id_user_distributor',
        'jumlah',
        'total',
        'tanggal',
        'bukti_transfer',
        'status_pemesanan',
    ];
}
