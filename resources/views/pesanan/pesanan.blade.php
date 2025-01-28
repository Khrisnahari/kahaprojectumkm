@extends('templatemenu')

@section('title', 'Darmasaba Digital Market - Pesanan Saya')

@section('content')
<div class="container">
    <div class="card col-lg-6 mx-auto">
        <div class="card-body">
            <h5 class="text-center">Pesanan Saya</h5>
            <div class="hr-dashed mt-3"></div>

            @if($transaksi->isNotEmpty())
                {{-- Informasi pengiriman hanya ditampilkan sekali --}}
                <div class="mt-3">
                    <h6>Dikirim ke:</h6>
                    <h6>{{ $transaksi->first()->pembeli->namalengkap }}</h6>
                    <h6>{{ $transaksi->first()->pembeli->alamat }}</h6>
                    <h6>{{ $transaksi->first()->pembeli->no_telp }}</h6>
                </div>
                <div class="hr-dashed mt-3"></div>

                {{-- Looping untuk setiap transaksi --}}
                @foreach ($transaksi as $item)
                    <div class="mt-3">
                        <h6>{{ $item->order_id }}</h6>
                        @if($item->status_pesanan == 'masuk')
                            <h6 class="badge bg-secondary" style="text-transform: capitalize">Pesanan {{ $item->status_pesanan }}</h6>
                            @elseif($item->status_pesanan == 'diproses')
                            <h6 class="badge bg-warning" style="text-transform: capitalize">Pesanan {{ $item->status_pesanan }}</h6>
                            @elseif($item->status_pesanan == 'dikirim')
                            <h6 class="badge bg-info" style="text-transform: capitalize">Pesanan {{ $item->status_pesanan }}</h6>
                            @elseif($item->status_pesanan == 'selesai')
                            <h6 class="badge bg-success" style="text-transform: capitalize">Pesanan {{ $item->status_pesanan }}</h6>
                        @endif
                        <h6>Tanggal Transaksi: {{ $item->created_at->format('d M Y, H:i') }}</h6>
                    </div>

                    {{-- Detail produk di dalam transaksi --}}
                    @foreach ($item->produk as $produk)
                        <div class="row mt-3">
                            <h6 class="fw-bold">{{ $produk->owner->umkm->nama_umkm ?? 'UMKM tidak ditemukan' }}</h6>
                            <div class="col-md-6">
                                <img src="{{ asset('/storage/produk/' . $produk->image) }}" alt="{{ $produk->nama_produk }}" class="img-fluid img-thumbnail">
                            </div>
                            <div class="col-md-6 mt-4">
                                <h6>Nama Produk: {{ $produk->nama_produk }}</h6>
                                <h6>Harga: Rp {{ number_format($produk->harga, 0, ',', '.') }}</h6>
                                <h6>Qty: {{ $produk->pivot->quantity }}</h6>
                                <h6>Total Pembayaran: Rp {{ number_format($produk->pivot->total, 0, ',', '.') }}</h6>
                            </div>
                        </div>
                        <div class="hr-dashed mt-3"></div>
                    @endforeach
                @endforeach
                <div class="text-center">
                    <a href="{{ route('home') }}" class="btn btn-primary mt-3">Kembali</a>
                </div>
            @else
                {{-- Jika tidak ada transaksi --}}
                <div class="text-center mt-3">
                    <h5>Belum ada pesanan.</h5>
                    <a href="{{ route('home') }}" class="btn btn-primary w-100 mt-3">Belanja Sekarang</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
