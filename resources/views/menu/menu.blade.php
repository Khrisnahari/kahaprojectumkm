@extends('templatemenu')
@section('title', 'Darmasaba Digital Market - ' . ($umkmData->nama_umkm ?? 'UMKM'))
@section('content')
<div class="container" style="margin-top:20px">
    <div style="margin-bottom:20px">
        <a href="{{ route('home') }}" style="text-decoration: none; color: inherit;">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 1-.5.5H3.707l3.147 3.146a.5.5 0 0 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L3.707 7.5H14.5A.5.5 0 0 1 15 8z"/>
            </svg>
        </a>
    </div>    
    <div class="card col-12" style="background: linear-gradient(to right, #66D9EF, #8AEF74); color: white; border: none;">
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
            @if($umkmData->kategori == 'Fashion')
                <h2 class="text-capitalize">Produk</h2>
                @else 
                <h2 class="text-capitalize">Menu</h2>
            @endif
            <hr> 
            <div class="row mt-3">
                @foreach($produks as $produk)
                <div class="col-md-4 col-lg-3 mb-4">
                    <div class="card" style="background: linear-gradient(to right, #05458a, #29b5d8); color: white; border: none; 
                    {{ (in_array($umkmData->kategori, ['Fashion', 'Skincare', 'Material Bangunan']) && $produk->stok == 0) ? 'opacity: 0.5; pointer-events: none;' : '' }}">
                        <img src="{{ asset('/storage/produk/'.$produk->image) }}" class="img-fluid img-thumbnail" style="width: 100%; height: 300px;" alt="{{ $produk->nama_produk }}">
                        <div class="card-body">
                            <h5 class="card-title text-capitalize">{{ $produk->nama_produk }}</h5>
                            <p class="card-text">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                            
                            {{-- Hanya tampilkan stok jika kategori bukan "Makanan" --}}
                            @if($umkmData->kategori != 'Makanan')
                                <div class="card-text" style="margin-top: -10px">{{ $produk->stok == 0 ? 'Stok Habis' : 'Stok: '.$produk->stok }}</div>
                            @endif
            
                            <div class="row mt-3">
                                <div class="col-6">
                                    @if ($umkmData->kategori == 'Fashion' || $umkmData->kategori == 'Skincare' || $umkmData->kategori == 'Material Bangunan')
                                        @if ($produk->stok > 0)
                                            @if (Auth::guard('pembeli')->check())
                                                <button class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#orderModal-{{ $produk->id }}">Order</button>
                                            @else
                                                <button class="btn btn-primary w-100" onclick="showLoginAlert()">Order</button>
                                            @endif
                                        @else
                                            <button class="btn btn-secondary w-100" disabled>Habis</button>
                                        @endif
                                    @else
                                        {{-- Untuk kategori makanan, tombol order selalu aktif --}}
                                        @if (Auth::guard('pembeli')->check())
                                            <button class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#orderModal-{{ $produk->id }}">Order</button>
                                        @else
                                            <button class="btn btn-primary w-100" onclick="showLoginAlert()">Order</button>
                                        @endif
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
                        <div class="modal-dialog modal-dialog-centered">
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
                                            <input type="number" class="form-control" id="quantity-{{ $produk->id }}" name="quantity" min="1" 
                                                {{ in_array($umkmData->kategori, ['Fashion', 'Skincare', 'Material Bangunan']) ? 'max='.$produk->stok : '' }} 
                                                value="1" required 
                                                oninput="validateQuantity({{ $produk->id }}, {{ $produk->stok }}, '{{ $umkmData->kategori }}')">
                                            <small id="quantityError-{{ $produk->id }}" class="text-danger" style="display: none;">Quantity melebihi stok yang ada</small>
                                        </div>
                                        <!-- Total Harga -->
                                        <div class="mb-3">
                                            <label for="totalPrice-{{ $produk->id }}" class="form-label">Total Harga</label>
                                            <input type="text" class="form-control" id="totalPrice-{{ $produk->id }}" value="Rp {{ number_format($produk->harga, 0, ',', '.') }}" readonly>
                                        </div>
                                        <!-- Tombol Tambah Pesanan -->
                                        <button type="submit" id="orderButton-{{ $produk->id }}" class="btn btn-primary w-100">Tambah Pesanan</button>
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
                    text: "Produk telah ditambahkan ke Keranjang!",
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
<script>
    function validateQuantity(productId, maxStock, category) {
        let quantityInput = document.getElementById(`quantity-${productId}`);
        let orderButton = document.getElementById(`orderButton-${productId}`);
        let errorMessage = document.getElementById(`quantityError-${productId}`);

        let quantity = parseInt(quantityInput.value);

        // Kategori yang memiliki batas stok
        let kategoriDenganStok = ["Fashion", "Skincare", "Material Bangunan"];

        // Jika kategori tidak termasuk dalam kategori yang memiliki stok, biarkan tanpa batasan
        if (!kategoriDenganStok.includes(category)) {
            errorMessage.style.display = "none";
            orderButton.disabled = false;
            return;
        }

        // Jika kategori memiliki batas stok, lakukan validasi
        if (quantity > maxStock) {
            errorMessage.style.display = "block"; // Tampilkan pesan error
            orderButton.disabled = true; // Nonaktifkan tombol order
        } else {
            errorMessage.style.display = "none"; // Sembunyikan pesan error
            orderButton.disabled = false; // Aktifkan tombol order kembali
        }
    }
</script>
@endsection
