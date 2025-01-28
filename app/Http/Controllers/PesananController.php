<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    public function tampilPesanan()
    {
        $pembeli = Auth::guard('pembeli')->user(); // Dapatkan pengguna yang sedang login

        // Ambil semua transaksi pengguna yang sudah berstatus 'success'
        $transaksi = Transaksi::with(['produk.owner.umkm', 'pembeli'])
            ->where('pembeli_id', $pembeli->id)
            ->where('status', 'success')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pesanan.pesanan', compact('transaksi'));
    }

    public function daftarPesanan($status)
    {
        $ownerId = Auth::guard('owner')->user()->id; // Ambil ID dari pengguna yang login

        $transaksi = Transaksi::with(['pembeli', 'produk.owner.umkm'])
        ->where('status_pesanan', $status)
        ->whereHas('produk.owner', function ($query) use ($ownerId) {
            $query->where('id', $ownerId);
        })
        ->get();

        return view('pesanan.daftar', ['transaksi' => $transaksi, 'status' => $status]);
    }


    public function ubahStatus(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $transaksi->update([
            'status_pesanan' => $request->status_pesanan,
        ]);

        return redirect()->back()->with('success', 'Status pesanan berhasil diubah.');
    }

}
