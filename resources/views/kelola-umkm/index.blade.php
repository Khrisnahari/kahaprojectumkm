@extends('template')
@section('title', 'Pasar Digital Darmasaba - Data UMKM')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body card-white">
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
                    <div class="card-body card-white">
                        <h4>Status Pesanan</h4>
                        <div class="row">
                            <div class="col-lg-3 mt-3">
                                <div class="card" onclick="window.location.href='{{ route('pesanan.daftar', 'masuk') }}'" style="cursor: pointer;">
                                    <div class="card-body card-custom">
                                        <h3 class="card-title text-white">Pesanan Masuk</h5>
                                        <div class="mt-3"></div>
                                        <h5 class="text-center text-white">{{ $totalPesananMasuk }}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 mt-3">
                                <div class="card" onclick="window.location.href='{{ route('pesanan.daftar', 'diproses') }}'" style="cursor: pointer;">
                                    <div class="card-body card-custom">
                                        <h5 class="text-center text-white">Pesanan Diproses</h5>
                                        <div class="mt-3"></div>
                                        <h5 class="text-center text-white">{{ $totalPesananDiproses }}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 mt-3">
                                <div class="card" onclick="window.location.href='{{ route('pesanan.daftar', 'dikirim') }}'" style="cursor: pointer;">
                                    <div class="card-body card-custom">
                                        <h5 class="text-center text-white">Pesanan Dikirim</h5>
                                        <div class="mt-3"></div>
                                        <h5 class="text-center text-white">{{ $totalPesananDikirim }}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 mt-3">
                                <div class="card" onclick="window.location.href='{{ route('pesanan.daftar', 'selesai') }}'" style="cursor: pointer;">
                                    <div class="card-body card-custom">
                                        <h5 class="text-center text-white">Pesanan Selesai</h5>
                                        <div class="mt-3"></div>
                                        <h5 class="text-center text-white">{{ $totalPesananSelesai }}</h5>
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
                            <div class="card-body card-white">
                                <a class="text-nowrap text-center d-block py-3 w-100">
                                    <img src="../assets/images/logos/produk-icon.png" alt="Produk Icon" style="width: 80px; height: auto;">
                                </a>
                                <h3 style="text-align: center">Produk</h3>
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
