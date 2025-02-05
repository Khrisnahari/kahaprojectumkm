@extends('template')
@section('title', 'Pasar Digital Darmasaba - Detail UMKM')
@section('content')
    <div class="container m-auto">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body card-white">
                        <h6 style="font-weight: bold">Foto UMKM</h6>
                        <hr>
                        <img src="{{ asset('/storage/umkm/' . $umkm->image) }}" class="rounded" style="width: 100%">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body card-white">
                        <div>
                            <h6 style="font-weight: bold">Detail UMKM</h6>
                        </div>
                        <hr>
                        <div>
                            <h6 style="font-weight: bold">Nama UMKM</h6>
                            <div class="fs-3 fw-semibold" style="margin-top: 3px">
                                {{ $umkm->nama_umkm }}
                            </div>
                        </div>
                        <div class="mt-4">
                            <h6 style="font-weight: bold">Kategori UMKM</h6>
                            <div class="fs-3 fw-semibold" style="margin-top: 3px">
                                {{ $umkm->kategori }}
                            </div>
                        </div>
                        <div class="mt-4">
                            <h6 style="font-weight: bold">Alamat</h6>
                            <div class="fs-3 fw-semibold" style="margin-top: 3px">
                                {{ $umkm->alamat }}
                            </div>
                        </div>
                        <div class="mt-4">
                            <h6 style="font-weight: bold">Tentang UMKM</h6>
                            <div class="fs-3 fw-semibold" style="margin-top: 3px">
                                {{ $umkm->deskripsi_umkm }}
                            </div>
                        </div>
                        <div class="mt-4">
                            <h6 style="font-weight: bold">Jam Buka</h6>
                            <div class="fs-3 fw-semibold" style="margin-top: 3px">
                                {{ $umkm->jam_buka }}
                            </div>
                        </div>
                        <div class="mt-4">
                            <h6 style="font-weight: bold">Jam Tutup</h6>
                            <div class="fs-3 fw-semibold" style="margin-top: 3px">
                                {{ $umkm->jam_tutup }}
                            </div>
                        </div>
                        <div class="mt-4">
                            <h6 style="font-weight: bold">Status</h6>
                            <div class="fs-3 fw-semibold" style="margin-top: 3px">
                                @if ($umkm->status == 'Verifikasi')
                                    <span class="badge bg-success rounded-3 fs-3 fw-semibold">Terverifikasi</span>
                                @else
                                    <span class="badge bg-status-danger rounded-3 fs-3 fw-semibold">Belum Verifikasi</span>
                                @endif 
                            </div>
                        </div>
                        <div class="mt-4">
                            <h6 style="font-weight: bold">Owner</h6>
                            <div class="fs-3 fw-semibold" style="margin-top: 3px">
                               {{$umkm->owner->namalengkap}}
                            </div>
                        </div>
                        <div class="mt-4">
                            <h6 style="font-weight: bold">No Handphone</h6>
                            <div class="fs-3 fw-semibold" style="margin-top: 3px">
                               {{$umkm->owner->no_telp}}
                            </div>
                        </div>
                        <hr>
                        <div>
                            <a href="{{ route('umkm.index') }}"
                                class="btn btn-sm btn-dark py-2 w-100 rounded-2 fs-4">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
