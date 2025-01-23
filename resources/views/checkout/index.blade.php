@extends('templatemenu')
@section('title', 'Checkout')
@section('content')
<div class="container">  
    <div class="card col-lg-5 col-12 mx-auto"> 
        <div class="card-title text-center mt-4">
            <h4>Checkout</h4>
        </div>
        <div class="card-body">
            <div class="hr-dashed"></div>
            <div class="p-2">
                <h6>{{ $pembeli->namalengkap }}</h6>
                <h6>{{ $pembeli->alamat }}</h6>
                <h6>{{ $pembeli->no_telp }}</h6>
            </div>
            <div class="hr-dashed"></div>
            @forelse ($carts as $cart)
                <div class="row mt-3 align-items-center">
                    <div class="col-3">
                        <img src="{{ asset('/storage/produk/'.$cart->produk->image) }}" class="img-fluid img-thumbnail" style="width: 100%; height: 100px;" alt="{{ $cart->produk->nama_produk }}">
                    </div>
                    <div class="col-5">
                        <h6>{{ $cart->produk->nama_produk }}</h6>
                        <p>Qty: {{ $cart->quantity }}</p>
                    </div>
                    <div class="col-4 text-end">
                        <p>Rp {{ number_format($cart->produk->harga * $cart->quantity, 0, ',', '.') }}</p>
                    </div>
                </div>
            @empty
                <p>Keranjang Anda kosong.</p>
            @endforelse

            <div class="hr-dashed mt-4"></div>

            <div class="row mt-3">
                <div class="col-8 text-end">
                    <h5><strong>Total :</strong></h5>
                </div>
                <div class="col-4 text-end">
                    <h5><strong>Rp {{ number_format($totalHarga, 0, ',', '.') }}</strong></h5>
                </div>
            </div>
            <button id="pay-button" type="submit" class="btn btn-success w-100 mt-3">Bayar Sekarang</button>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
<script type="text/javascript">
    document.getElementById('pay-button').onclick = function(){
        snap.pay('{{ $transaksi->snap_token }}', {
            // Callback untuk setiap status transaksi
            onSuccess: function (result) {
                console.log(result);
                // Redirect ke controller 'success' dengan parameter order_id
                window.location.href = "{{ route('checkout.success') }}?order_id=" + result.order_id;
            },
            onPending: function(result){
                document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            },
            onError: function(result){
                document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            }
        });
    };
</script>
@endsection
