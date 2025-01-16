@extends('template')
@section('title', 'Pasar Digital Darmasaba - Data UMKM')
@section('content')
    <div class="d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-lg-10 col-12" style="margin-top:12px">
                        <h5 class="card-title fw-semibold mb-4">Data Pembeli</h5>
                    </div>
                    <hr>
                </div>
                <div class="table-responsive">
                    <table class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 style="font-weight: bold" class="mb-0">No</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 style="font-weight: bold" class="mb-0">Nama Pembeli</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 style="font-weight: bold" class="mb-0">No Telpon</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 style="font-weight: bold" class="mb-0">Alamat</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 style="font-weight: bold" class="mb-0">Aksi</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pembelis as $pembeli)
                                <tr>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">{{ $no++ }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">{{ $pembeli->namalengkap }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">{{ $pembeli->no_telp }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">{{ $pembeli->alamat }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <form id="deleteForm" action="{{ route('pembeli.destroy', $pembeli->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm bg-status-danger" style="color: white"
                                                onclick="confirmDelete(event)">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <div class="alert alert-danger">
                                    Data Pembeli Belum Tersedia.
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $pembelis->links() }}
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
