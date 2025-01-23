<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Services\MidtransService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends Controller
{

    public function checkout($id)
    {
        // Ambil transaksi berdasarkan ID
        $transaksi = Transaksi::find($id);
    
        // Cek jika transaksi tidak ditemukan
        if (!$transaksi) {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
        }
    
        // Ambil data pembeli melalui relasi di model Transaksi
        $pembeli = $transaksi->pembeli; // Pastikan relasi 'pembeli' sudah dibuat di model Transaksi

        $carts = $pembeli->carts;
    
        if (!$carts || $carts->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong.');
        }
    
        // Hitung total harga
        $totalHarga = $carts->reduce(function ($carry, $cart) {
            return $carry + ($cart->produk->harga * $cart->quantity);
        }, 0);
    
        // Kirim data transaksi dan pembeli ke tampilan
        return view('checkout.index', compact('transaksi', 'pembeli', 'carts', 'totalHarga'));
    }

    public function proses(Request $request)
    {
        $data = $request->all();

        $pembeli = Auth::guard('pembeli')->user();
        $orderId = 'ORDER-' . uniqid();

        $transaksi = Transaksi::create([
            'order_id' => $orderId,
            'pembeli_id' => $pembeli->id,
            'produk_id' => $data['produk_id'] ?? null,
            'quantity' => $data['quantity'] ?? 0,
            'total' => $data['total'] ?? 0,
            'status' => 'pending',
            'status_pesanan' => 'masuk'
        ]);

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $orderId,
                'gross_amount' => $data['total'],
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        
        $transaksi->snap_token = $snapToken;

        $transaksi->save();

        return redirect()->route('checkout.index', $transaksi->id);
    }

    public function success(Request $request)
    {
        // Ambil data order_id dari request
        $orderId = $request->get('order_id');
    
        // Cari transaksi berdasarkan order_id
        $transaksi = Transaksi::where('order_id', $orderId)->first();
    
        // Periksa apakah transaksi ditemukan
        if (!$transaksi) {
            return redirect()->route('home')->with('error', 'Transaksi tidak ditemukan.');
        }
    
        // Perbarui status transaksi menjadi 'success'
        $transaksi->status = 'success';
        $transaksi->status_pesanan = 'diproses';
        $transaksi->save();

        $pembeli = Auth::guard('pembeli')->user(); // Dapatkan pengguna yang sedang login
        Cart::where('pembeli_id', $pembeli->id)->delete();
    
        // Redirect ke halaman sukses atau tampilkan pesan sukses
        return view('checkout.success', compact('transaksi'));
    }
}
