@extends('template')
@section('title', 'Pasar Digital Darmasaba - Dashboard')
@section('content')
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body gradient-card">
                    <h5 class="card-title mb-9 fw-semibold">Total UMKM</h5>
                    <div class="row align-items-center">
                        <div class="col-lg-4">
                            <h4 class="fw-semibold">{{ $totalUmkm }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body gradient-card">
                    <h5 class="card-title mb-9 fw-semibold">Total Terverifikasi</h5>
                    <div class="row align-items-center">
                        <div class="col-lg-4">
                            <h4 class="fw-semibold">{{ $totalVerifikasiUmkm }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body gradient-card">
                    <h5 class="card-title mb-9 fw-semibold">Total Belum Verifikasi</h5>
                    <div class="row align-items-center">
                        <div class="col-lg-4">
                            <h4 class="fw-semibold">{{ $totalBelumverifikasiUmkm }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body gradient-card">
                    <h5 class="card-title mb-9 fw-semibold">Total Pembeli</h5>
                    <div class="row align-items-center">
                        <div class="col-lg-4">
                            <h4 class="fw-semibold">{{ $totalPembeli }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
