@extends('template')
@section('title', 'Pasar Digital Darmasaba - Data UMKM')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                @if ($umkms->isEmpty())
                    <div class="row">
                        <div class="col-lg-10" style="margin-top: 6px">
                            <h4>Silahkan daftarkan UMKM anda.</h4>
                        </div>
                        <div class="col-lg-2">
                            <a href="{{ route('kelolaumkm.create') }}"
                                class="btn btn-sm btn-primary p-2 fs-4 rounded-2 w-100"><span class="ti ti-check"></span>
                                Daftar UMKM</a>
                        </div>
                    </div>
                @else
                    <div class="row">
                        @foreach ($umkms as $umkm)
                            <div class="col-lg-10">
                                <h4>{{ $umkm->nama_umkm }}</h4>
                            </div>
                            <div class="col-lg-2">
                                @if ($umkm->status == 'Verifikasi')
                                    <span class="badge bg-success rounded-3 fs-3 fw-semibold">Terverifikasi</span>
                                @else
                                    <span class="badge bg-status-danger rounded-3 fs-3 fw-semibold">Menunggu
                                        Verifikasi</span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
        @if(isset($umkm) && $umkm->status === 'Verifikasi')
            <div class="mt-4">
                <div class="card">
                    <div class="card-body">
                        <h4>Status Pesanan</h4>
                        <div class="row">
                            <div class="col-lg-3 mt-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-center">Pesanan Masuk</h5>
                                        <div class="mt-3"></div>
                                        <h5 class="text-center">{{ $totalPesananMasuk }}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 mt-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-center">Pesanan Diproses</h5>
                                        <div class="mt-3"></div>
                                        <h5 class="text-center">{{ $totalPesananDiproses }}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 mt-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-center">Pesanan Dikirim</h5>
                                        <div class="mt-3"></div>
                                        <h5 class="text-center">{{ $totalPesananDikirim }}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 mt-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-center">Pesanan Selesai</h5>
                                        <div class="mt-3"></div>
                                        <h5 class="text-center">{{ $totalPesananSelesai }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card" onclick="window.location.href='{{route('produk.index')}}'" style="cursor: pointer;">
                            <div class="card-body">
                                <a class="text-nowrap text-center d-block py-3 w-100">
                                    <img src="../assets/images/logos/favicon.png" alt="">
                                </a>
                                <h4 style="text-align: center">Produk</h4>
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
        @endif
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
