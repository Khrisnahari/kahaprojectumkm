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
        'deskripsi_umkm',
        'jam_buka',
        'jam_tutup',
        'status',
        'image',
        'owner_id'
    ];

    // protected $casts = [
    //     'image' => 'array', // Mengubah kolom 'images' menjadi array saat diakses
    // ];

    public function owner()
    {
        return $this->belongsTo(Owner::class, 'owner_id', 'id');
    }

    protected $table = 'umkm';
}
