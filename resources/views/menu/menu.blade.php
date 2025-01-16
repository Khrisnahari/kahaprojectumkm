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
                            <strong>Buka</strong>
                            <p>{{ $umkmData->jam_buka }}</p>
                        </div>
                        <div class="col-lg-2">
                            <strong>Tutup</strong>
                            <p>{{ $umkmData->jam_tutup }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-5">
        @php
            use Carbon\Carbon;
            $now = Carbon::now()->format('H:i');
        @endphp

        @if ($now >= $umkmData->jam_buka && $now <= $umkmData->jam_tutup)
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
                                        @if (Auth::guard('pembeli')->check())
                                            <!-- Jika pembeli sudah login -->
                                            <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#orderModal-{{ $produk->id }}">Order</button>
                                        @else
                                            <!-- Jika pembeli belum login -->
                                            <button class="btn btn-primary w-100" onclick="showLoginAlert()">Order</button>
                                        @endif
                                    </div>
                                    <div class="col-6">
                                        <a href="#" class="btn btn-secondary w-100">Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Order -->
                    <div class="modal fade" id="orderModal-{{ $produk->id }}" tabindex="-1" aria-labelledby="orderModalLabel-{{ $produk->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="orderModalLabel-{{ $produk->id }}">Order Pesanan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="order-form-{{ $produk->id }}" onsubmit="event.preventDefault(); addToCart({{ $produk->id }})">
                                        @csrf
                                        <!-- Jumlah Produk -->
                                        <div class="mb-3">
                                            <label for="quantity-{{ $produk->id }}" class="form-label">Jumlah</label>
                                            <input type="number" class="form-control" id="quantity-{{ $produk->id }}" name="quantity" min="1" value="1" required>
                                        </div>
                                        <!-- Total Harga -->
                                        <div class="mb-3">
                                            <label for="totalPrice-{{ $produk->id }}" class="form-label">Total Harga</label>
                                            <input type="text" class="form-control" id="totalPrice-{{ $produk->id }}" value="Rp {{ number_format($produk->harga, 0, ',', '.') }}" readonly>
                                        </div>
                                        <!-- Tombol Tambah Pesanan -->
                                        <button type="submit" class="btn btn-primary w-100">Tambah Pesanan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>                    
                @endforeach
            </div>
        @else
            <!-- Toko Tutup -->
            <div class="alert alert-danger mt-4" role="alert">
                <h4 class="alert-heading">Toko Sudah Tutup</h4>
                <p>Mohon maaf, toko saat ini tidak melayani pesanan. Jam operasional toko adalah dari <strong>{{ $umkmData->jam_buka }}</strong> sampai <strong>{{ $umkmData->jam_tutup }}</strong>.</p>
            </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function addToCart(productId) {
    const quantity = document.getElementById(`quantity-${productId}`).value;

    fetch("{{ route('cart.add') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
        },
        body: JSON.stringify({
            produk_id: productId,
            quantity: quantity,
        }),
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                // Tampilkan notifikasi berhasil
                Swal.fire({
                    title: "Berhasil",
                    text: "Produk telah ditambahkan ke Pesanan Saya!",
                    icon: "success",
                });

                // Perbarui badge pesanan
                updateCartBadge(data.totalItems);

                // Tutup modal
                const modal = bootstrap.Modal.getInstance(document.getElementById(`orderModal-${productId}`));
                modal.hide();
            } else {
                Swal.fire({
                    title: "Gagal",
                    text: data.message || "Terjadi kesalahan.",
                    icon: "error",
                });
            }
        })
        .catch((error) => {
            Swal.fire({
                title: "Gagal",
                text: "Terjadi kesalahan saat menambahkan produk.",
                icon: "error",
            });
        });
}
</script>
<script>
function updateCartBadge(totalItems) {
    const badge = document.getElementById("cart-badge");
    badge.textContent = totalItems;
}
</script>
<script>
    function showLoginAlert() {
        Swal.fire({
            title: 'Silahkan Login',
            text: 'Anda harus login sebelum melakukan order.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Login',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('login') }}?redirect=" + encodeURIComponent(window.location.href);
            }
        });
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        @foreach ($produks as $produk)
        const quantityInput{{ $produk->id }} = document.getElementById('quantity-{{ $produk->id }}');
        const totalPriceInput{{ $produk->id }} = document.getElementById('totalPrice-{{ $produk->id }}');
        const harga{{ $produk->id }} = {{ $produk->harga }};
        
        quantityInput{{ $produk->id }}.addEventListener('input', function () {
            const jumlah = parseInt(this.value) || 1;
            const total = jumlah * harga{{ $produk->id }};
            totalPriceInput{{ $produk->id }}.value = `Rp ${total.toLocaleString('id-ID')}`;
        });
        @endforeach
    });
</script>
@endsection
