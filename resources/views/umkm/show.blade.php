@extends('template')
@section('title', 'Pasar Digital Darmasaba - Detail UMKM')
@section('content')
<div class="container m-auto">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h6 style="font-weight: bold">Foto UMKM</h6>
                    <hr>
                    <img src="{{ asset('/storage/umkm/'.$umkm->image) }}" class="rounded" style="width: 100%">
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div>
                        <h6 style="font-weight: bold">Detail UMKM</h6>
                    </div>
                    <hr>
                    <div>
                        <h6 style="font-weight: bold">Nama UMKM</h6>
                        <div class="fs-3 fw-semibold" style="margin-top: 3px">
                            {{$umkm->nama_umkm}}
                        </div>
                    </div>
                    <div class="mt-4">
                        <h6 style="font-weight: bold">Kategori UMKM</h6>
                        <div class="fs-3 fw-semibold" style="margin-top: 3px">
                            {{$umkm->kategori}}
                        </div>
                    </div>
                    <div class="mt-4">
                        <h6 style="font-weight: bold">Alamat</h6>
                        <div class="fs-3 fw-semibold" style="margin-top: 3px">
                            {{$umkm->alamat}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection