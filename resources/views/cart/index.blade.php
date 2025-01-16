@extends('templatemenu')
@section('title', 'Darmasaba Digital Market - ' . ($umkmData->nama_umkm ?? 'UMKM'))
@section('content')

<!-- Blade untuk Menampilkan Daftar Keranjang -->
<table class="table">
    <thead>
        <tr>
            <th>Produk</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Total</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($carts as $cart)
            <tr>
                <td>{{ $cart->produk->nama_produk }}</td>
                <td>{{ $cart->quantity }}</td>
                <td>Rp {{ number_format($cart->produk->harga, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($cart->produk->harga * $cart->quantity, 0, ',', '.') }}</td>
                <td>
                    <button class="btn btn-danger btn-sm" onclick="removeFromCart({{ $cart->id }})">Hapus</button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">Keranjang Anda kosong.</td>
            </tr>
        @endforelse
    </tbody>
</table>

@endsection
