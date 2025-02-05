@extends('templatemenu')

@section('title', 'Semua Berita')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Semua Berita</h2>

    <div class="list-group">
        @foreach ($beritas as $berita)
            <a href="{{ route('berita.showBerita', $berita->id) }}" class="list-group-item list-group-item-action d-flex">
                <img src="{{ asset('uploads/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="img-thumbnail me-3" style="width: 150px; height: 120px; object-fit: cover;">
                <div>
                    <h5 class="mb-1 fw-bold text-dark">{{ strtoupper($berita->judul) }}</h5>
                    <p class="text-dark mb-1">
                        {{ \Illuminate\Support\Str::limit(strip_tags($berita->konten), 150, '...') }}
                    </p>
                    <p class="text-muted mb-0">
                        {{ \Carbon\Carbon::parse($berita->created_at)->format('d M Y') }} • {{ $berita->halaman }}
                    </p>
                </div>
            </a>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $beritas->links() }}
    </div>
</div>

@endsection
