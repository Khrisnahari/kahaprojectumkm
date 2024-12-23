@extends('template')
@section('title', 'Pasar Digital Darmasaba - Data UMKM')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            @foreach($umkms as $umkm)
                <h3>{{$umkm->nama_umkm}}</h3>
            @endforeach
        </div>
    </div>
    <div class="mt-4">
        <div class="card">
            <div class="card-body">
                <h4>Status Pesanan</h4>
            </div>
        </div>
    </div>
    <div class="mt-4">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 style="text-align: center">Produk</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                         <h4 style="text-align: center">Produk</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                         <h4 style="text-align: center">Produk</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    //message with sweetalert
    @if (session('success'))
        Swal.fire({
            icon: "success",
            title: "BERHASIL",
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 2000
        });
    @elseif (session('error'))
        Swal.fire({
            icon: "error",
            title: "GAGAL!",
            text: "{{ session('error') }}",
            showConfirmButton: false,
            timer: 2000
        });
    @endif
</script>
@endsection