@extends('templatemenu')
@section('title', 'Darmasaba Digital Market - Pesanan Saya')
@section('content')
<div class="container">  
    <div class="card col-lg-5 col-12 mx-auto"> 
        <div class="card-title text-center mt-4">
            <h4>Order Summary</h4>
        </div>
        <div class="card-body">
            <div class="hr-dashed">
                @php
                    $totalHarga = 0;
                @endphp

                @forelse ($carts as $cart)
                    @php
                        $subTotal = $cart->produk->harga * $cart->quantity;
                        $totalHarga += $subTotal;
                    @endphp

                    <div class="row mt-4 align-items-center">
                        <div class="col-3">
                            <img src="{{ asset('/storage/produk/'.$cart->produk->image) }}" class="img-fluid img-thumbnail" style="width: 100%; height: 100px;" alt="{{ $cart->produk->nama_produk }}">
                        </div>
                        <div class="col-3">
                            <h6>Qty</h6>
                            <div class="d-flex align-items-center">
                                <form action="{{ route('cart.decrease', $cart->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-outline-secondary">-</button>
                                </form>
                                <span class="mx-2">{{ $cart->quantity }}</span>
                                <form action="{{ route('cart.increase', $cart->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-outline-secondary">+</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-3">
                            <h6>Nama</h6>
                            <h6>{{ $cart->produk->nama_produk }}</h6>
                        </div>

                        <div class="col-3">
                            <h6>Harga</h6>
                            <h6>Rp {{ number_format($cart->produk->harga, 0, ',', '.') }}</h6>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-8 text-end">
                            <strong>Subtotal:</strong>
                        </div>
                        <div class="col-4">
                            <strong>Rp {{ number_format($subTotal, 0, ',', '.') }}</strong>
                        </div>
                    </div>
                    <hr>

                @empty
                    <div class="text-center mt-4">
                        <h6>Keranjang Anda kosong.</h6>
                        <a href="{{ route('home') }}" class="btn btn-primary mt-3">Belanja Sekarang</a>
                    </div>
                @endforelse

                @if($totalHarga > 0)
                    <div class="row mt-4">
                        <div class="col-6 col-lg-8 text-end">
                            <h5><strong>Total :</strong></h5>
                        </div>
                        <div class="col-6 col-lg-4">
                            <h5><strong>Rp {{ number_format($totalHarga, 0, ',', '.') }}</strong></h5>
                        </div>
                    </div>

                    <div class="hr-dashed mt-3"></div>

                    <div class="row mt-3">
                        <div class="col-6">
                            <form action="{{ route('checkout.proses') }}" method="POST">
                                @csrf
                                <input type="hidden" name="total" value="{{ $totalHarga }}">
                                <input type="hidden" name="produk_id" value="{{ $carts->first()->produk_id }}"> <!-- Ambil produk_id -->
                                <button type="submit" class="btn btn-sm btn-success w-100">Checkout</button>
                            </form>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('home') }}" class="btn btn-sm btn-primary w-100"><i class="bi bi-plus"></i> Tambah Item</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
