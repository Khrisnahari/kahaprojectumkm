@extends('template')

@section('title', 'Pasar Digital Darmasaba - Daftar Pesanan')

@section('content')
<div class="container mt-4">
    <h4>Pesanan {{ ucfirst($status) }}</h4>
    <div class="row">
        @forelse ($transaksi as $item)
            <div class="col-lg-6 mt-3">
                <div class="card">
                    <div class="card-body card-white">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <th>ID Pesanan</th>
                                    <td>:</td>
                                    <td>{{ $item->order_id }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Pesanan</th>
                                    <td>:</td>
                                    <td>{{ $item->created_at->format('d M Y, H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Pembeli</th>
                                    <td>:</td>
                                    <td>{{ $item->pembeli->namalengkap }}</td>
                                </tr>
                                <tr>
                                    <th>Alamat Pengiriman</th>
                                    <td>:</td>
                                    <td>{{ $item->pembeli->alamat }}</td>
                                </tr>
                                <tr>
                                    <th>No HP</th>
                                    <td>:</td>
                                    <td>{{ $item->pembeli->no_telp }}</td>
                                </tr>
                                <tr>
                                    <th>Total</th>
                                    <td>:</td>
                                    <td>Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Tampilkan produk dalam tabel -->
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th>Nama Produk</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($item->produk as $produk)
                                    <tr>
                                        <td>{{ $produk->nama_produk }}</td>
                                        <td>{{ $produk->pivot->quantity }} pcs</td>
                                        <td>Rp {{ number_format($produk->pivot->total, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        @if ($status != 'selesai')
                        <div class="hr-dashed mb-2"></div>
                            <div class="row gap-2">
                                <div class="col-md-2">
                                    <div class="mt-2">
                                        <a href="{{ route('kelolaumkm.index') }}" class="btn btn-light">Kembali</a>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <form action="{{ route('pesanan.ubahStatus', $item->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="status_pesanan" value="{{ $status == 'masuk' ? 'diproses' : ($status == 'diproses' ? 'dikirim' : 'selesai') }}">
                                        <button type="submit" class="btn btn-primary mt-2">
                                             Pesanan {{ $status == 'masuk' ? 'Diproses' : ($status == 'diproses' ? 'Dikirim' : 'Selesai') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
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
