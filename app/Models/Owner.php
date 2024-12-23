<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Model;

class Owner extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'password',
        'email',
        'namalengkap',
        'no_telp'
    ];
    protected $table = 'owner';

     public function umkm()
    {
        return $this->hasOne(Umkm::class, 'owner_id', 'id');
    }
}
