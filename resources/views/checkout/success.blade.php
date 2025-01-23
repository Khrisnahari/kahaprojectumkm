@extends('templatemenu')

@section('title', 'Pembayaran Berhasil')

@section('content')
<div class="container text-center">
    <div class="card col-lg-4 mt-5 mx-auto">
        <div class="card-header">
            <h4>Pembayaran Berhasil</h4>
        </div>
        <div class="card-body">
            <h5>Terima kasih, {{ $transaksi->pembeli->namalengkap }}!</h5>
            <h6 class="mt-3">Pesanan Anda dengan Order ID <strong>{{ $transaksi->order_id }}</strong> telah berhasil diproses.</h6>
            <h6 class="mt-3">Total Pembayaran: <strong>Rp {{ number_format($transaksi->total, 0, ',', '.') }}</strong></h6>
            <h6 class="mt-3"><span class="badge bg-success" style="text-transform: capitalize">{{ $transaksi->status }}</span></h6>
            <div class="row">
                <div class="col-lg-6">
                    <a href="{{ route('pesanansaya') }}" class="btn btn-success mt-3">Lihat Pesanan</a>
                </div>
                <div class="col-lg-6">
                    <a href="{{ route('home') }}" class="btn btn-primary mt-3">Kembali ke Beranda</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
