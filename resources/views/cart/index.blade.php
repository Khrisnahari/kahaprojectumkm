@extends('templatemenu')
@section('title', 'Darmasaba Digital Market - Pesanan Saya')
@section('content')
<div class="container">  
    <div class="card card-white col-lg-5 col-12 mx-auto" style="margin-top: 20px"> 
        <div class="card-title text-center mt-4">
            <h4>Keranjang Saya</h4>
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
                        <div>
                            <h6 class="fw-bold">{{ $cart->produk->owner->umkm->nama_umkm }}</h6>
                        </div>
                        <div class="col-3 mt-2">
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
                        <h6>Keranjang anda kosong.</h6>
                        <div class="hr-dashed mt-3"></div>
                        <a href="{{ route('home') }}#mobile-products" class="btn btn-primary mt-3 w-100">Belanja Sekarang</a>
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
                                @foreach($carts as $cart)
                                    <input type="hidden" name="produk[{{ $loop->index }}][id]" value="{{ $cart->produk_id }}">
                                    <input type="hidden" name="produk[{{ $loop->index }}][quantity]" value="{{ $cart->quantity }}">
                                    <input type="hidden" name="produk[{{ $loop->index }}][harga]" value="{{ $cart->produk->harga }}">
                                    <input type="hidden" name="produk[{{ $loop->index }}][nama_produk]" value="{{ $cart->produk->nama_produk }}">
                                @endforeach
                                <button type="submit" class="btn btn-sm btn-success w-100">Checkout</button>
                            </form>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('home') }}#mobile-products" class="btn btn-sm btn-primary w-100"><i class="bi bi-plus"></i> Tambah Item</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
