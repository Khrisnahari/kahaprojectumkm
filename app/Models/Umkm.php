<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_umkm',
        'kategori',
        'alamat',
        'status',
        'image'
    ];

    // protected $casts = [
    //     'image' => 'array', // Mengubah kolom 'images' menjadi array saat diakses
    // ];

    protected $table = 'umkm';
}
