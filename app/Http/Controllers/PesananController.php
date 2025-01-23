<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    public function tampilPesanan()
    {
        $pembeli = Auth::guard('pembeli')->user();// Dapatkan pengguna yang sedang login

        // Ambil semua transaksi pengguna yang sudah berstatus 'success'
        $transaksi = Transaksi::with('produk')
            ->where('pembeli_id', $pembeli->id)
            ->where('status', 'success')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pesanan.pesanan', compact('transaksi'));
    }
}
