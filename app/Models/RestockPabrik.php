<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestockPabrik extends Model
{
     // Nama tabel yang digunakan model
     protected $table = 'restock_pabrik';

     // Primary key dari tabel
     protected $primaryKey = 'id_restock';
 
     // Mengatur timestamps (created_at dan updated_at)
     public $timestamps = true;
 
     // Kolom yang dapat diisi
     protected $fillable = [
         'id_user_pabrik',
         'jumlah',
         'tanggal',
     ];
}
