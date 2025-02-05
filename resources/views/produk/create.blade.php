@extends('template')
@section('title', 'Pasar Digital Darmasaba - Tambah Produk')
@section('content')
    <div class="card  col-lg-5">
        <div class="card-body card-white">
            <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
                    <h5 class="fw-semibold">Tambah Produk</h5>
                </div>
                <hr>
                <div class="mt-3">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nama Produk</label>
                        <input type="nama_produk" class="form-control" id="nama_produk" name="nama_produk">
                        @if ($errors->has('nama_produk'))
                            <span class="text-danger">{{ $errors->first('nama_produk') }}</span>
                        @endif
                    </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4"></textarea>
                            @if ($errors->has('deskripsi'))
                                <span class="text-danger">{{ $errors->first('deskripsi') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Harga</label>
                        <input type="harga" class="form-control" id="harga" name="harga">
                        @if ($errors->has('harga'))
                            <span class="text-danger">{{ $errors->first('harga') }}</span>
                        @endif
                    </div>
                    @if ($umkm->kategori === 'Fashion' || $umkm->kategori === 'Skincare' || $umkm->kategori === 'Material Bangunan')
                    <div class="mb-3">
                        <label for="stok" class="form-label">Stok</label>
                        <input type="number" class="form-control" id="stok" name="stok">
                        @if ($errors->has('stok'))
                            <span class="text-danger">{{ $errors->first('stok') }}</span>
                        @endif
                    </div>
                    @endif
                    <div class="mb-3">
                        <label class="form-label">Foto Produk 1:1</label>
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
                            <a href="{{ route('produk.index') }}" class="btn btn-sm btn-dark py-8 w-100 rounded-2 fs-4">Kembali</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
