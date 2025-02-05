@extends('template')
@section('title', 'Pasar Digital Darmasaba - Buat Berita')
@section('content')
    <div class="d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body card-white p-4">
                <div class="row align-items-center">
                    <div class="col">
                        <h5 class="card-title fw-semibold mb-0">Konten Berita</h5>
                    </div>
                    <div class="col-auto">
                        <a href="{{ route('berita.create') }}" class="btn btn-primary">Tambah Berita</a>
                    </div>
                </div>
                <hr>                
            <table class="table">
                <thead>
                    <tr>
                        <th class="border-bottom-0">
                            <h6 style="font-weight: bold" class="mb-0">Halaman</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 style="font-weight: bold" class="mb-0">Judul</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 style="font-weight: bold" class="mb-0">Konten</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 style="font-weight: bold" class="mb-0">Gambar</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 style="font-weight: bold" class="mb-0">Video</h6>
                        </th>
                        <th class="border-bottom-0">
                            <h6 style="font-weight: bold" class="mb-0">Aksi</h6>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($beritas as $berita)
                        <tr>
                            <td>{{ $berita->halaman }}</td>
                            <td>{{ $berita->judul }}</td>
                            <td>{{ $berita->konten }}</td>
                            <td>
                                @if ($berita->gambar)
                                    <img src="{{ asset('uploads/' . $berita->gambar) }}" alt="Gambar" width="100">
                                @else
                                    <span class="text-muted">Tidak ada gambar</span>
                                @endif
                            </td>
                            <td>
                                @if ($berita->video)
                                    <iframe width="200" height="150" src="{{ $berita->video }}" frameborder="0" allowfullscreen></iframe>
                                @else
                                    <span class="text-muted">Tidak ada video</span>
                                @endif
                            </td>

                            <td class="border-bottom-0">
                                <form id="deleteForm" action="{{ route('berita.destroy', $berita->id) }}" method="POST" onsubmit="return confirmDelete(event, this)">
                                    <a href="{{ route('berita.edit', $berita->id) }}"
                                        class="btn btn-sm btn-success">Edit</a>
                                    <a href="{{ route('berita.show', $berita->id) }}"
                                        class="btn btn-sm btn-dark">Detail</a>
                                    @csrf
                                    @method('DELETE')
                                    <div style="margin-top:4px">
                                        <button type="submit" class="btn btn-sm bg-status-danger" style="color: white">Delete</button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
