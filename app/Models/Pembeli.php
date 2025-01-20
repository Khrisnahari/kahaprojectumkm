<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Model;

class Pembeli extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'password',
        'email',
        'namalengkap',
        'no_telp',
        'alamat'
    ];
    protected $table = 'pembeli';

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'pembeli_id');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class, 'pembeli_id');
    }
}
