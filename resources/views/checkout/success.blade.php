@extends('templatemenu')

@section('title', 'Pembayaran Berhasil')

@section('content')
<div class="container text-center">
    <div class="card mt-5">
        <div class="card-header">
            <h4>Pembayaran Berhasil</h4>
        </div>
        <div class="card-body">
            <h5>Terima kasih, {{ $transaksi->pembeli->namalengkap }}!</h5>
            <p>Pesanan Anda dengan Order ID <strong>{{ $transaksi->order_id }}</strong> telah berhasil diproses.</p>
            <p>Total Pembayaran: <strong>Rp {{ number_format($transaksi->total, 0, ',', '.') }}</strong></p>
            <p>Status Transaksi: <span class="badge bg-success">{{ $transaksi->status }}</span></p>
            <a href="{{ route('home') }}" class="btn btn-primary mt-3">Kembali ke Beranda</a>
        </div>
    </div>
</div>
@endsection
