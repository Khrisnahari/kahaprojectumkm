@extends('templatemenu')
@section('title', 'Darmasaba Digital Market - ' . ($umkmData->nama_umkm ?? 'UMKM'))
@section('content')
<div class="container">
    <div style="margin-bottom:20px">
        <a href="{{ route('home') }}" style="text-decoration: none; color: inherit;">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 1-.5.5H3.707l3.147 3.146a.5.5 0 0 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L3.707 7.5H14.5A.5.5 0 0 1 15 8z"/>
            </svg>
        </a>
    </div>    
    <div class="card col-12">
        <div class="card-detail p-4">
            <div class="row">
                <div class="col-sm-12 col-lg-2">
                    <img src="{{ asset('/storage/umkm/' . $umkmData->image) }}" class="rounded-circle img-fluid img-thumbnail" style="width: 100%">
                </div>
                <div class="col-sm-12 col-lg-5 mt-5">
                    <h3 style="text-transform: capitalize">{{ $umkmData->nama_umkm }}</h3>
                    <p>{{ $umkmData->deskripsi_umkm }}</p>
                    <div class="row">
                        <div class="col-lg-2">
                            Buka <span> <p>{{ $umkmData->jam_buka }}</p></span>
                        </div>
                        <div class="col-lg-2">
                            Tutup <span> <p>{{ $umkmData->jam_tutup }}</p></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-5">
        @php
            // Ambil waktu sekarang dalam format jam:menit
            $now = date('H:i');
        @endphp
    
        @if ($now >= $umkmData->jam_buka && $now <= $umkmData->jam_tutup)
            <!-- Tampilkan Menu Jika Toko Buka -->
            <h2 class="text-capitalize">Menu</h2>
            <hr> 
            <div class="row mt-3">
                @foreach($produks as $produk)
                    <div class="col-md-4 col-lg-3 mb-4">
                        <div class="card">
                            <img src="{{ asset('/storage/produk/'.$produk->image) }}" class="img-fluid img-thumbnail" style="width: 100%; height: 300px;" alt="{{ $produk->nama_produk }}">
                            <div class="card-body">
                                <h5 class="card-title text-capitalize">{{ $produk->nama_produk }}</h5>
                                <p class="card-text">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                                <div class="row">
                                    <div class="col-6">
                                        <a href="#" class="btn btn-primary w-100">Order</a>
                                    </div>
                                    <div class="col-6">
                                        <a href="#" class="btn btn-secondary w-100">Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Tampilkan Pesan Jika Toko Tutup -->
            <div class="alert alert-danger mt-4" role="alert">
                <h4 class="alert-heading">Toko Sudah Tutup</h4>
                <p>Mohon maaf, toko saat ini tidak melayani pesanan. Jam operasional toko adalah dari <strong>{{ $umkmData->jam_buka }}</strong> sampai <strong>{{ $umkmData->jam_tutup }}</strong>.</p>
            </div>
        @endif
    </div>    
</div>
@endsection