@extends('template')
@section('title', 'Pasar Digital Darmasaba - Buat Berita')
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
            <a href="{{ route('berita.create') }}" class="btn btn-primary mb-3" style="left: 12px">Tambah Berita</a>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Halaman</th>
                        <th>Judul</th>
                        <th>Konten</th>
                        <th>Gambar</th>
                        <th>Video</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($beritas as $berita)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
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
                            <td>
                                <form action="{{ route('berita.destroy', $berita->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                                <a href="{{ route('berita.edit', $berita->id) }}"
                                    style="background-color: rgb(0, 38, 255); color: white"
                                    class="btn btn-sm">Edit</a>
                                    <a href="{{ route('berita.show', $berita->id) }}"
                                        style="background-color: rgb(0, 38, 255); color: white"
                                        class="btn btn-sm">Show</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
