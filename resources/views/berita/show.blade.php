<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pasar Digital Darmasaba</title>
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
</head>
<body>
<div class="container mt-5">
    <a href="{{ route('home') }}" class="btn btn-light mb-4">← Kembali</a>

    <h1>{{ $berita->judul }}</h1>
    <p class="text-muted">
        {{ \Carbon\Carbon::parse($berita->created_at)->format('d M Y') }} • Oleh: {{ $berita->halaman }} • {{ $berita->views }} kali dibaca
    </p>

    <!-- Gambar -->
    @if ($berita->gambar)
    <div class="mb-4">
        <img src="{{ asset('uploads/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="img-fluid">
    </div>
    @endif

    <!-- Konten -->
    <div class="content mb-4">
        <p>{{ $berita->konten }}</p>
    </div>

    <!-- Media: Foto atau Video -->
    <div class="mb-4">
        <h5>Media (Foto atau Video)</h5>
        <div class="row">
            <div class="col-md-6">
                @if ($berita->gambar)
                <img src="{{ asset('uploads/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="img-fluid">
                @endif
            </div>
            <div class="col-md-6">
                @if ($berita->video)
                <button type="button" class="btn btn-light position-relative" data-bs-toggle="modal" data-bs-target="#videoModal">
                    <img src="https://via.placeholder.com/150x100?text=Video" alt="Video" class="img-fluid">
                    <div class="position-absolute top-50 start-50 translate-middle">
                        <i class="fa fa-play-circle fa-2x"></i>
                    </div>
                </button>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal untuk Video -->
    <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="videoModalLabel">Tonton Video</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="ratio ratio-16x9">
                        <iframe src="{{ $berita->video }}" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Social Share -->
    <div class="social-share">
        <p>Bagikan:</p>
        <a href="#" class="btn btn-light">Facebook</a>
        <a href="#" class="btn btn-light">Twitter</a>
        <a href="#" class="btn btn-light">WhatsApp</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
