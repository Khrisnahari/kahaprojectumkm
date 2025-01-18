<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\ProdukUmkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function index()
    {
        // Ambil data keranjang berdasarkan pengguna yang sedang login
        $carts = Cart::with('produk')
            ->where('pembeli_id', Auth::guard('pembeli')->user()->id)
            ->get();

        // Hitung total item jika perlu
        $totalItems = $carts->sum('quantity');

        return view('cart.index', compact('carts', 'totalItems'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produk,id',
            'quantity' => 'required|integer|min:1',
        ]);


        // Periksa apakah produk sudah ada di keranjang
        $cartItem = Cart::where('pembeli_id', Auth::guard('pembeli')->user()->id)
            ->where('produk_id', $request->produk_id)
            ->first();

        if ($cartItem) {
            // Jika sudah ada, tambahkan jumlahnya
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            // Jika belum ada, tambahkan item baru
            Cart::create([
                'pembeli_id' => Auth::guard('pembeli')->user()->id,
                'produk_id' => $request->produk_id,
                'quantity' => $request->quantity,
            ]);
        }

        // Hitung total item
        $totalItems = Cart::where('pembeli_id', Auth::guard('pembeli')->user()->id)->sum('quantity');

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil ditambahkan ke keranjang.',
            'totalItems' => $totalItems,
        ]);
    }

    public function increaseQuantity($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->quantity += 1;
        $cart->save();

        return back();
    }

    public function decreaseQuantity($id)
    {
        $cart = Cart::findOrFail($id);
        if ($cart->quantity > 1) {
            $cart->quantity -= 1;
            $cart->save();
        }

        return back();
    }
}
