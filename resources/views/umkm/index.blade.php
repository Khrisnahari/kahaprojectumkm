@extends('template')
@section('title', 'Pasar Digital Darmasaba - Data UMKM')
@section('content')
    <div class="d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body card-white p-4">
                <div class="row">
                    <div class="col-lg-10 col-12" style="margin-top:12px">
                        <h5 class="card-title fw-semibold mb-4">Data UMKM</h5>
                    </div>
                    {{-- <div class="col-lg-2 col-12">
                        <a href="{{ route('umkm.create') }}"
                            class="btn btn-sm btn-primary p-2 fs-4 mb-4 rounded-2 w-100"><span class="ti ti-plus"></span>
                            UMKM</a>
                    </div> --}}
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
                                    <h6 style="font-weight: bold" class="mb-0">Nama UMKM</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 style="font-weight: bold" class="mb-0">Kategori UMKM</h6>
                                </th>
                                <th class="border-bottom-0" style="white-space: normal; word-wrap: break-word; max-width: 250px;">
                                    <h6 style="font-weight: bold" class="mb-0">Alamat</h6>
                                </th>
                                
                                <th class="border-bottom-0">
                                    <h6 style="font-weight: bold" class="mb-0">Status</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 style="font-weight: bold" class="mb-0">Aksi</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($umkms as $umkm)
                                <tr>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">{{ $no++ }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">{{ $umkm->nama_umkm }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">{{ $umkm->kategori }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">{{ $umkm->alamat }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <div class="d-flex align-items-center gap-2">
                                            @if ($umkm->status == 'Verifikasi')
                                                <span
                                                    class="badge bg-success rounded-3 fs-3 fw-semibold">Terverifikasi</span>
                                            @else
                                                <span class="badge bg-status-danger rounded-3 fs-3 fw-semibold">Belum
                                                    Verifikasi</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="border-bottom-0">
                                        <form id="deleteForm" action="{{ route('umkm.destroy', $umkm->id) }}"method="POST" onsubmit="return confirmDelete(event, this)">
                                            <a href="{{ route('umkm.show', $umkm->id) }}"
                                                class="btn btn-sm btn-dark">Detail</a>
                                            {{-- <a href="{{ route('umkm.edit', $umkm->id) }}"
                                                style="background-color: rgb(0, 38, 255); color: white"
                                                class="btn btn-sm">Edit</a> --}}
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm bg-status-danger" style="color: white">Delete</button>
                                        </form>
                                        <div class="mt-1">
                                            @if ($umkm->status !== 'Verifikasi')
                                                <form id="verifyForm" action="{{ route('umkm.verifikasi', $umkm->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="button" class="btn btn-sm btn-success"
                                                        onclick="confirmVerif(event)">Verifikasi UMKM</button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <div class="alert alert-danger">
                                    Data UMKM Belum Tersedia.
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $umkms->links() }}
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmVerif(event) {
            event.preventDefault(); // Mencegah form submit langsung

            Swal.fire({
                title: 'Apakah Anda yakin ingin verifikasi?',
                text: 'Pastikan data UMKM sudah valid!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Verifikasi',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Kirim form jika dikonfirmasi
                    document.getElementById('verifyForm').submit();
                }
            });
        }
    </script>
   <script>
    function confirmDelete(event, formElement) {
        event.preventDefault(); // Mencegah submit otomatis

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
                formElement.submit(); // Submit form yang sesuai
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
