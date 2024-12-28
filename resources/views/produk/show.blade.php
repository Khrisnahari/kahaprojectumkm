@extends('template')
@section('title', 'Pasar Digital Darmasaba - Detail Produk')
@section('content')
    <div class="container m-auto">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h6 style="font-weight: bold">Foto Produk</h6>
                        <hr>
                        <img src="{{ asset('/storage/produk/' . $produk->image) }}" class="rounded" style="width: 100%">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <h6 style="font-weight: bold">Detail Produk</h6>
                        </div>
                        <hr>
                        <div>
                            <h6 style="font-weight: bold">Nama Produk</h6>
                            <div class="fs-3 fw-semibold" style="margin-top: 3px">
                                {{ $produk->nama_produk }}
                            </div>
                        </div>
                        <div class="mt-4">
                            <h6 style="font-weight: bold">Deksripsi</h6>
                            <div class="fs-3 fw-semibold" style="margin-top: 3px">
                                {{ $produk->deskripsi }}
                            </div>
                        </div>
                        <div class="mt-4">
                            <h6 style="font-weight: bold">Harga</h6>
                            <div class="fs-3 fw-semibold" style="margin-top: 3px">
                                {{ $produk->harga }}
                            </div>
                        </div>
                        <div class="mt-4">
                            <h6 style="font-weight: bold">Stok</h6>
                            <div class="fs-3 fw-semibold" style="margin-top: 3px">
                                {{ $produk->stok }}
                            </div>
                        </div>
                        <hr>
                        <div>
                            <a href="{{ route('produk.index') }}"
                                class="btn btn-sm btn-dark py-2 w-100 rounded-2 fs-4">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
