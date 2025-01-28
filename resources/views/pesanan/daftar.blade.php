@extends('template')

@section('title', 'Daftar Pesanan')

@section('content')
<div class="container mt-4">
    <h4>Pesanan {{ ucfirst($status) }}</h4>
    <div class="row">
        @forelse ($transaksi as $item)
            <div class="col-lg-6 mt-3">
                <div class="card">
                    <div class="card-body">
                        <h6>ID Pesanan: {{ $item->order_id }}</h6>
                        <h6>Pembeli: {{ $item->pembeli->namalengkap }}</h6>
                        <h6>Total: Rp {{ number_format($item->total, 0, ',', '.') }}</h6>
                        <h6>Tanggal Pesanan: {{ $item->created_at->format('d M Y, H:i') }}</h6>

                        <!-- Tampilkan nama produk -->
                        <h6>Produk:</h6>
                        <ul>
                            @foreach ($item->produk as $produk)
                                <li>
                                    {{ $produk->nama_produk }} - 
                                    {{ $produk->pivot->quantity }} pcs - 
                                    Rp {{ number_format($produk->pivot->total, 0, ',', '.') }}
                                </li>
                            @endforeach
                        </ul>
                        
                        @if ($status != 'selesai')
                            <form action="{{ route('pesanan.ubahStatus', $item->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="status_pesanan" value="{{ $status == 'masuk' ? 'diproses' : ($status == 'diproses' ? 'dikirim' : 'selesai') }}">
                                <button type="submit" class="btn btn-primary mt-2">
                                     Pesanan {{ $status == 'masuk' ? 'Diproses' : ($status == 'diproses' ? 'Dikirim' : 'Selesai') }}
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning">Tidak ada pesanan yang {{ ucfirst($status) }}.</div>
            </div>
        @endforelse
    </div>
</div>
@endsection
