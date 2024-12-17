@extends('template')
@section('title', 'Pasar Digital Darmasaba - Data UMKM')
@section('content')
<div class="row gap-4">
    <div class="card col-lg-4">
        <div class="card-body">
           <h6>Foto UMKM</h6>
           <hr>
           <img src="{{ asset('/storage/umkm/'.$umkm->image) }}" class="rounded" style="width: 200px">
        </div>
    </div>
    <div class="card col-lg-6">
        <div class="card-body">
            <div>
                <h6>Detail UMKM</h6>
            </div>
            <hr>
            <div>
                <h6 class="fw-bold">Nama UMKM</h6>
                <div class="fs-3" style="margin-top: 3px">
                    {{$umkm->nama_umkm}}
                </div>
            </div>
            <div class="mt-4">
                <h6 class="fw-bold">Kategori UMKM</h6>
                <div class="fs-3" style="margin-top: 3px">
                    {{$umkm->kategori}}
                </div>
            </div>
            <div class="mt-4">
                <h6 class="fw-bold">Alamat</h6>
                <div class="fs-3" style="margin-top: 3px">
                    {{$umkm->alamat}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection