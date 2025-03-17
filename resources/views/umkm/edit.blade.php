@extends('template')
@section('title', 'Pasar Digital Darmasaba - Edit UMKM')
@section('content')
    <div class="card  col-lg-5">
        <div class="card-body">
            <form action="{{ route('umkm.update', $umkm->id) }}" method="POST" enctype="multipart/form-data">

                @csrf
                @method('PUT')
                <div>
                    <h5>Edit UMKM</h5>
                </div>
                <hr>
                <div class="mt-3">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nama UMKM</label>
                        <input type="nama_umkm" class="form-control" id="nama_umkm" name="nama_umkm"
                            value="{{ old('nama_umkm', $umkm->nama_umkm) }}">
                        @if ($errors->has('nama_umkm'))
                            <span class="text-danger">{{ $errors->first('nama_umkm') }}</span>
                        @endif
                    </div>
                    <div class="mt-3">
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori UMKM</label>
                            <select name="kategori" class="form-select">
                                <option value="">Pilih Kategori</option>
                                <option value="Fashion"
                                    {{ old('kategori', $umkm->kategori) == 'Fashion' ? 'selected' : '' }}>Fashion</option>
                                <option value="Makanan"
                                    {{ old('kategori', $umkm->kategori) == 'Makanan' ? 'selected' : '' }}>Makanan</option>
                                <option value="Material Bangunan"
                                    {{ old('kategori', $umkm->kategori) == 'Material Bangunan' ? 'selected' : '' }}>Material Bangun</option>
                                <option value="Skincare"
                                    {{ old('kategori', $umkm->kategori) == 'Skincare' ? 'selected' : '' }}>Skincare</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Alamat</label>
                            <input type="alamat" class="form-control" id="alamat" name="alamat"
                                value="{{ old('alamat', $umkm->alamat) }}">
                            @if ($errors->has('alamat'))
                                <span class="text-danger">{{ $errors->first('alamat') }}</span>
                            @endif
                        </div>
                        <div class="mt-3">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tentang UMKM</label>
                                <input type="alamat" class="form-control" id="deskripsi_umkm" name="deskripsi_umkm"
                                    value="{{ old('deskripsi_umkm', $umkm->deskripsi_umkm) }}">
                                @if ($errors->has('deskripsi_umkm'))
                                    <span class="text-danger">{{ $errors->first('deskripsi_umkm') }}</span>
                                @endif
                            </div>
                            <div class="mt-3">
                                <div class="mb-3">
                                    <label class="form-label">Foto UMKM</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror"
                                        name="image">
                                    @if ($errors->has('image'))
                                        <span class="text-danger">{{ $errors->first('image') }}</span>
                                    @endif
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Simpan</button>
                                    </div>
                                    <div class="col-lg-6">
                                        <a href="{{ route('umkm.index') }}" class="btn btn-sm btn-dark py-8 w-100 rounded-2 fs-4">Kembali</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
