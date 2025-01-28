@extends('template')
@section('title', 'Pasar Digital Darmasaba - Data Produk')
@section('content')
    <div class="d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-lg-10 col-12" style="margin-top:12px">
                        <h5 class="card-title fw-semibold mb-4">Data Produk</h5>
                    </div>
                    <div class="col-lg-2 col-12">
                        <a href="{{ route('produk.create') }}"
                            class="btn btn-sm btn-primary p-2 fs-4 mb-4 rounded-2 w-100"><span class="ti ti-plus"></span>
                            Produk</a>
                    </div>
                    <hr>
                </div>
                <div class="table-responsive">
                    <table class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0"><h6 style="font-weight: bold" class="mb-0">No</h6></th>
                                <th class="border-bottom-0"><h6 style="font-weight: bold" class="mb-0">Nama Produk</h6></th>
                                <th class="border-bottom-0"><h6 style="font-weight: bold" class="mb-0">Deskripsi</h6></th>
                                <th class="border-bottom-0"><h6 style="font-weight: bold" class="mb-0">Harga</h6></th>
                                
                                <!-- Tambahkan class 'stok-column' ke kolom stok dan sembunyikan jika kategori adalah 'Makanan' -->
                                <th class="border-bottom-0 stok-column" style="{{ $umkm->kategori == 'Makanan' ? 'display:none;' : '' }}">
                                    <h6 style="font-weight: bold" class="mb-0">Stok</h6>
                                </th>
                
                                <th class="border-bottom-0"><h6 style="font-weight: bold" class="mb-0">Aksi</h6></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($produks as $produk)
                                <tr>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ $no++ }}</h6></td>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ $produk->nama_produk }}</h6></td>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ $produk->deskripsi }}</h6></td>
                                    <td class="border-bottom-0"><h6 class="fw-semibold mb-0">Rp {{ number_format($produk->harga, 0, ',', '.') }}</h6></td>
                
                                    <!-- Tambahkan class 'stok-column' ke kolom stok dan sembunyikan jika kategori adalah 'Makanan' -->
                                    <td class="border-bottom-0 stok-column" style="{{ $umkm->kategori == 'Makanan' ? 'display:none;' : '' }}">
                                        <h6 class="fw-semibold mb-0">{{ $produk->stok }}</h6>
                                    </td>
                
                                    <td class="border-bottom-0">
                                        <form id="deleteForm" action="{{ route('produk.destroy', $produk->id) }}" method="POST">
                                            <a href="{{ route('produk.show', $produk->id) }}" class="btn btn-sm btn-dark">Detail</a>
                                            <a href="{{ route('produk.edit', $produk->id) }}" style="background-color: rgb(0, 38, 255); color: white" class="btn btn-sm">Edit</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm bg-status-danger" style="color: white" onclick="confirmDelete(event)">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">
                                        <div class="alert alert-danger">
                                            Data Produk Belum Tersedia.
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $produks->links() }}
                </div>
                               
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(event) {
            event.preventDefault(); // Mencegah form untuk submit langsung

            // Menggunakan SweetAlert untuk konfirmasi
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika diklik 'Hapus', kirimkan form
                    document.getElementById('deleteForm').submit();
                }
            });
        }
    </script>
    <script>
        //message with sweetalert
        @if (session('success'))
            Swal.fire({
                icon: "success",
                title: "BERHASIL",
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @elseif (session('error'))
            Swal.fire({
                icon: "error",
                title: "GAGAL!",
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif
    </script>
@endsection
