<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukUmkm extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'nama_produk',
        'deskripsi',
        'harga',
        'stok',
        'owner_id',
    ];

    public function owner()
    {
        return $this->belongsTo(Owner::class, 'owner_id', 'id');
    }

    public function umkm()
    {
        return $this->belongsTo(Umkm::class, 'umkm_id', 'id');
    }

    public function transaksi()
    {
        return $this->belongsToMany(Transaksi::class, 'transaksi_produk')
                    ->withPivot('quantity', 'total')
                    ->withTimestamps();
    }

    protected $table = 'produk';
}
