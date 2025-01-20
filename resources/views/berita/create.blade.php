@extends('template')
@section('title', 'Pasar Digital Darmasaba - Tambah Tulisan')
@section('content')
    <div class="card col-lg-8 mx-auto mt-4">
        <div class="card-body">
            <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Header -->
                <div>
                    <h5 class="text-center">Tambah Tulisan</h5>
                </div>
                <hr>
                
                <!-- Halaman -->
                <div class="mb-3">
                    <label for="halaman" class="form-label">Halaman</label>
                    <select class="form-select @error('halaman') is-invalid @enderror" id="halaman" name="halaman">
                        <option value="">Pilih Halaman</option>
                        <option value="1" {{ old('halaman') == 1 ? 'selected' : '' }}>Berita Desa</option>
                        <option value="2" {{ old('halaman') == 2 ? 'selected' : '' }}>Pengumuman</option>
                    </select>
                    @error('halaman')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Judul -->
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" placeholder="Masukan Judul" value="{{ old('judul') }}">
                    @error('judul')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Konten Tulisan -->
                <div class="mb-3">
                    <label for="konten" class="form-label">Konten Tulisan</label>
                    <textarea class="form-control @error('konten') is-invalid @enderror" id="konten" name="konten" rows="6">{{ old('konten') }}</textarea>
                    @error('konten')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="gambar" class="form-label">Upload Gambar</label>
                    <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="gambar" name="gambar">
                    @error('gambar')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>    

                <div class="mb-3">
                    <label for="video" class="form-label">Video YouTube (URL /embed)</label>
                    <input type="text" class="form-control @error('video') is-invalid @enderror" id="video" name="video" placeholder="Masukkan URL Video (format: https://www.youtube.com/embed/...)" value="{{ old('video') }}">
                    @error('video')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>            
                
                <hr>
                
                <!-- Buttons -->
                <div class="row">
                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-primary w-100 py-2 rounded-2">Simpan</button>
                    </div>
                    <div class="col-lg-6">
                        <a href="{{ route('berita.index') }}" class="btn btn-dark w-100 py-2 rounded-2">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
