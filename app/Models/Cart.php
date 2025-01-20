<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['pembeli_id', 'produk_id', 'quantity'];

    protected $table = 'cart';

    public function produk()
    {
        return $this->belongsTo(ProdukUmkm::class, 'produk_id');
    }

    public function pembeli() {
        return $this->belongsTo(Pembeli::class, 'pembeli_id');
    } 
}
