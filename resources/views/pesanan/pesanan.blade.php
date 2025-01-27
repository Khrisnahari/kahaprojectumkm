@extends('templatemenu')

@section('title', 'Darmasaba Digital Market - Pesanan Saya')

@section('content')
<div class="container">
    <div class="card col-lg-6 mx-auto">
        <div class="card-body">
            <h5 class="text-center">Pesanan Saya</h5>
            <div class="hr-dashed mt-3"></div>

            @if($transaksi->isNotEmpty())
                {{-- Tampilkan informasi pengiriman sekali saja --}}
                <div class="mt-3">
                    <h6>Dikirim ke:</h6>
                    <h6>{{ $transaksi->first()->pembeli->namalengkap }}</h6>
                    <h6>{{ $transaksi->first()->pembeli->alamat }}</h6>
                    <h6>{{ $transaksi->first()->pembeli->no_telp }}</h6>
                </div>
                <div class="hr-dashed mt-3"></div>

                {{-- Looping informasi pesanan --}}
                @foreach ($transaksi as $item)
                    <div class="mt-3">
                        <h6>{{ $item->order_id }}</h6>
                    </div>
                    <div>
                        <h6 class="badge bg-success" style="text-transform: capitalize">Pesanan {{ $item->status_pesanan }}</h6>
                    </div>
                    <div>
                        <h6>Tanggal Transaksi: {{ $item->created_at->format('d M Y, H:i') }}</h6>
                    </div>
                    <div class="hr-dashed mt-3"></div>
                    <div class="mt-3">
                        <h6 class="fw-bold">{{ $item->produk->owner->umkm->nama_umkm }}</h6>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <img src="{{ asset('/storage/produk/' . $item->produk->image) }}" alt="{{ $item->produk->nama_produk }}" class="img-fluid img-thumbnail">
                        </div>
                        <div class="col-md-6 mt-4">
                            <div>
                                <h6>Nama: {{ $item->produk->nama_produk }}</h6>
                                <h6>Harga: Rp {{ number_format($item->produk->harga, 0, ',', '.') }}</h6>
                                <h6>Qty: {{ $item->quantity }}</h6>
                                <h6>Total Pembayaran: Rp {{ number_format($item->total, 0, ',', '.') }}</h6>
                                @if($item->status == 'success')
                                    <h6 class="badge bg-success">Pembayaran Berhasil</h6>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="hr-dashed mt-3"></div>
                @endforeach
            @else
                <div class="text-center mt-3">
                    <h5>Belum ada pesanan.</h5>
                    <a href="{{ route('home') }}" class="btn btn-primary mt-3">Belanja Sekarang</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
