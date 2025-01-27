<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'order_id',
        'pembeli_id', // Kolom pembeli_id menggantikan user_id
        'produk_id',
        'quantity',
        'total',
        'status',
        'status_pesanan',
        'snap_token'
    ];
    
    protected $table = 'transaksi';

    // Relasi ke pembeli
    public function pembeli()
    {
        return $this->belongsTo(Pembeli::class, 'pembeli_id');
    }

    public function produk()
    {
        return $this->belongsTo(ProdukUmkm::class, 'produk_id');
    }

    
    // public function produk()
    // {
    //     return $this->belongsToMany(ProdukUmkm::class, 'transaksi')
    //                 ->withPivot('quantity', 'total')
    //                 ->withTimestamps();
    // }
}
