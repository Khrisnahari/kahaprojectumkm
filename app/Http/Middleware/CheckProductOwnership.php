<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProdukUmkm;

class CheckProductOwnership
{
    public function handle(Request $request, Closure $next)
    {
        $productId = $request->route('id'); // Ambil ID produk dari URL
        $produk = ProdukUmkm::find($productId); // Cari produk berdasarkan ID

        if (!$produk) {
            abort(404, 'Produk tidak ditemukan'); // Produk tidak ditemukan
        }

        $ownerId = Auth::guard('owner')->user()->id; // Ambil ID owner yang sedang login

        if ($produk->owner_id !== $ownerId) {
            abort(403, 'Anda tidak memiliki akses ke produk ini'); // Owner salah
        }

        return $next($request); // Lanjutkan jika owner benar
    }
}

