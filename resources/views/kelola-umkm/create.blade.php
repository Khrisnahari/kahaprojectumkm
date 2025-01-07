@extends('template')
@section('title', 'Pasar Digital Darmasaba - Tambah UMKM')
@section('content')
    <div class="card  col-lg-5">
        <div class="card-body">
            <form action="{{ route('kelolaumkm.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
                    <h5>Daftar UMKM</h5>
                </div>
                <hr>
                <div class="mt-3">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nama UMKM</label>
                        <input type="nama_umkm" class="form-control" id="nama_umkm" name="nama_umkm">
                        @if ($errors->has('nama_umkm'))
                            <span class="text-danger">{{ $errors->first('nama_umkm') }}</span>
                        @endif
                    </div>
                    <div class="mt-3">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Kategori UMKM</label>
                            <select name="kategori" class="form-select">
                                <option value="Pilih Kategori">Pilih Kategori</option>
                                <option value="Fashion">Fashion</option>
                                <option value="Makanan">Makanan</option>
                            </select>
                        </div>
                        <div class="mt-3">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Alamat</label>
                                <input type="alamat" class="form-control" id="alamat" name="alamat">
                                @if ($errors->has('alamat'))
                                    <span class="text-danger">{{ $errors->first('alamat') }}</span>
                                @endif
                            </div>
                            <div class="mt-3">
                                <div class="mb-3">
                                    <label for="deskripsi_umkm" class="form-label">Tentang UMKM</label>
                                    <textarea class="form-control" id="deskripsi_umkm" name="deskripsi_umkm" rows="4"></textarea>
                                    @if ($errors->has('deskripsi_umkm'))
                                        <span class="text-danger">{{ $errors->first('deskripsi_umkm') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Jam Buka</label>
                                            <input type="time" class="form-control" id="jam_buka" name="jam_buka">
                                            @if ($errors->has('jam_buka'))
                                                <span class="text-danger">{{ $errors->first('jam_buka') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Jam Tutup</label>
                                            <input type="time" class="form-control" id="jam_tutup" name="jam_tutup">
                                            @if ($errors->has('jam_tutup'))
                                                <span class="text-danger">{{ $errors->first('jam_tutup') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
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
                                        <a href="{{ route('kelolaumkm.index') }}" class="btn btn-sm btn-dark py-8 w-100 rounded-2 fs-4">Kembali</a>
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