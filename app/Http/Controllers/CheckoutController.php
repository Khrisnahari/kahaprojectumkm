<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\ProdukUmkm;
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

        // Validasi input
        $request->validate([
            'produk' => 'required|array',
            'produk.*.id' => 'required|exists:produk,id',
            'produk.*.quantity' => 'required|integer|min:1',
            'produk.*.harga' => 'required|numeric|min:0',
        ]);

        // Buat transaksi
        $transaksi = Transaksi::create([
            'order_id' => $orderId,
            'pembeli_id' => $pembeli->id,
            'total' => 0, // Total dihitung setelah semua produk ditambahkan
            'status' => 'pending',
            'status_pesanan' => 'masuk',
        ]);

        // Hitung total harga dan simpan ke pivot table
        $totalHarga = 0;
        foreach ($data['produk'] as $produk) {
            $subtotal = $produk['quantity'] * $produk['harga'];
            $totalHarga += $subtotal;

            // Simpan ke tabel pivot
            $transaksi->produk()->attach($produk['id'], [
                'quantity' => $produk['quantity'],
                'total' => $subtotal,
            ]);
            
             // Tambahkan produk ke item_details
            $itemDetails[] = [
                'id' => $produk['id'], // Produk ID
                'price' => $produk['harga'], // Harga satuan
                'quantity' => $produk['quantity'], // Jumlah
                'name' => substr($produk['nama_produk'], 0, 50), // Nama produk (maks 50 karakter)
            ];

            $owner = ProdukUmkm::find($produk['id'])->owner; // Pastikan relasi owner ada di model Produk
            if ($owner) {
                $sellerDetails[] = "Seller : {$owner->umkm->nama_umkm}";
            }

            // Ubah seller details menjadi string agar lebih mudah dibaca di Midtrans
            $sellerInfo = implode(" | ", $sellerDetails);
        }

        // Update total transaksi
        $transaksi->update(['total' => $totalHarga]);

        // Midtrans setup
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $totalHarga,
            ],
            'item_details' => $itemDetails,
            'customer_details' => [
                'first_name' => $pembeli->namalengkap,
                'email' => $pembeli->email,
                'phone' => $pembeli->no_telp,
                'shipping_address' => [
                    'first_name' => $pembeli->namalengkap,
                    'address' => $pembeli->alamat, // Alamat pengiriman
                    'phone' => $pembeli->no_telp,
                ],
            ],
            'custom_field1' => $sellerInfo,
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        // Simpan snap token ke transaksi
        $transaksi->update(['snap_token' => $snapToken]);

        // Redirect ke halaman checkout
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

        // Kurangi stok produk sesuai dengan quantity yang dibeli
        foreach ($transaksi->produk as $produk) {
            $produkUmkm = ProdukUmkm::find($produk->id);
            if ($produkUmkm) {
                $produkUmkm->stok -= $produk->pivot->quantity; // Kurangi stok berdasarkan jumlah yang dibeli
                $produkUmkm->save();
            }
        }

        $pembeli = Auth::guard('pembeli')->user(); // Dapatkan pengguna yang sedang login
        Cart::where('pembeli_id', $pembeli->id)->delete();
    
        // Redirect ke halaman sukses atau tampilkan pesan sukses
        return view('checkout.success', compact('transaksi'));
    }
}
