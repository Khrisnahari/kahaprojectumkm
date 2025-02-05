@extends('template')
@section('title', 'Edit Berita')
@section('content')
    <div class="card col-lg-8 mx-auto mt-4">
        <div class="card-body card-white">
            <form action="{{ route('berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="col-lg-10 col-12" style="margin-top:12px">
                    <h4 class="card-title fw-semibold mb-4">Edit Berita</h4>
                </div>
                <hr>

                <!-- Halaman -->
                <div class="mb-3">
                    <label for="halaman" class="form-label">Halaman</label>
                    <select class="form-select @error('halaman') is-invalid @enderror" id="halaman" name="halaman">
                        <option value="">Pilih Halaman</option>
                        <option value="1" {{ $berita->halaman == '1' ? 'selected' : '' }}>Berita Desa</option>
                        <option value="2" {{ $berita->halaman == '2' ? 'selected' : '' }}>Pengumuman</option>
                    </select>
                    @error('halaman')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Judul -->
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul', $berita->judul) }}" placeholder="Masukan Judul">
                    @error('judul')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Konten -->
                <div class="mb-3">
                    <label for="konten" class="form-label">Konten</label>
                    <textarea class="form-control @error('konten') is-invalid @enderror" id="konten" name="konten" rows="6">{{ old('konten', $berita->konten) }}</textarea>
                    @error('konten')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Video -->
                <div class="mb-3">
                    <label for="video" class="form-label">Video YouTube (URL /embed)</label>
                    <input type="text" class="form-control @error('video') is-invalid @enderror" id="video" name="video" value="{{ old('video', $berita->video) }}" placeholder="Masukkan URL Video (format: https://www.youtube.com/embed/...)">
                    @error('video')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Gambar -->
                <div class="mb-3">
                    <label for="gambar" class="form-label">Upload Gambar</label>
                    <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="gambar" name="gambar">
                    @if ($berita->gambar)
                        <div class="mt-2">
                            <img src="{{ asset('uploads/' . $berita->gambar) }}" alt="Gambar Berita" width="150">
                        </div>
                    @endif
                    @error('gambar')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <hr>

                <!-- Buttons -->
                <div class="row">
                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-primary w-100 py-2 rounded-2">Simpan Perubahan</button>
                    </div>
                    <div class="col-lg-6">
                        <a href="{{ route('berita.index') }}" class="btn btn-dark w-100 py-2 rounded-2">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
