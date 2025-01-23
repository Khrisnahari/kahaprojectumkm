@extends('templatemenu')

@section('title', 'Darmasaba Digital Market - Pesanan Saya')

@section('content')
<div class="container mt-5">
    <h3 class="text-center mb-4">Pesanan Saya</h3>

    @forelse ($transaksi as $item)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Order ID: {{ $item->order_id }}</h5>
                <p class="card-text">
                    <strong>Status:</strong> <span class="badge bg-success">{{ $item->status }}</span><br>
                    <strong>Tanggal Transaksi:</strong> {{ $item->created_at->format('d M Y, H:i') }}<br>
                    <strong>Total Pembayaran:</strong> Rp {{ number_format($item->total, 0, ',', '.') }}
                </p>
                <hr>
                <h6>Detail Produk:</h6>
                <div class="row">
                    <div class="col-md-3">
                        <img src="{{ asset('/storage/produk/' . $item->produk->image) }}" alt="{{ $item->produk->nama_produk }}" class="img-fluid img-thumbnail">
                    </div>
                    <div class="col-md-9">
                        <p>
                            <strong>Nama Produk:</strong> {{ $item->produk->nama_produk }}<br>
                            <strong>UMKM:</strong> {{ $item->produk->owner->umkm->nama_umkm }}<br>
                            <strong>Harga:</strong> Rp {{ number_format($item->produk->harga, 0, ',', '.') }}<br>
                            <strong>Jumlah:</strong> {{ $item->quantity }}<br>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="text-center">
            <h5>Belum ada pesanan.</h5>
            <a href="{{ route('home') }}" class="btn btn-primary mt-3">Belanja Sekarang</a>
        </div>
    @endforelse
</div>
@endsection
