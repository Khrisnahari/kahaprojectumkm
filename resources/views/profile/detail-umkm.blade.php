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
                        <img src="{{ asset('/storage/umkm/' . $umkm->image) }}" class="rounded" style="width: 100%">
                    </div>
                </div>
                <div class="card">
                    <div class="card-body" style="margin-bottom: -30px">
                        <form action="{{ route('updateumkm', $umkm->id) }}" method="POST" enctype="multipart/form-data">

                            @csrf
                            @method('PUT')
                            <div>
                                <h5>Edit UMKM</h5>
                            </div>
                            <hr>
                            <div class="mt-3">
                                <div class="mb-3">
                                    <label class="form-label">Nama UMKM</label>
                                    <input type="nama_umkm" class="form-control" id="nama_umkm" name="nama_umkm"
                                        value="{{ old('nama_umkm', $umkm->nama_umkm) }}">
                                    @if ($errors->has('nama_umkm'))
                                        <span class="text-danger">{{ $errors->first('nama_umkm') }}</span>
                                    @endif
                                </div>
                                <div class="mt-3">
                                    <div class="mb-3">
                                        <label class="form-label">Kategori UMKM</label>
                                        <select name="kategori" class="form-select">
                                            <option value="">Pilih Kategori</option>
                                            <option value="Fashion"
                                                {{ old('kategori', $umkm->kategori) == 'Fashion' ? 'selected' : '' }}>
                                                Fashion</option>
                                            <option value="Makanan"
                                                {{ old('kategori', $umkm->kategori) == 'Makanan' ? 'selected' : '' }}>
                                                Makanan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div class="mb-3">
                                        <label class="form-label">Alamat</label>
                                        <input type="alamat" class="form-control" id="alamat" name="alamat"
                                            value="{{ old('alamat', $umkm->alamat) }}">
                                        @if ($errors->has('alamat'))
                                            <span class="text-danger">{{ $errors->first('alamat') }}</span>
                                        @endif
                                    </div>
                                    <div class="mt-3">
                                        <div class="mb-3">
                                            <label class="form-label">Tentang UMKM</label>
                                            <textarea class="form-control" id="deskripsi_umkm" name="deskripsi_umkm" rows="5">{{ old('deskripsi_umkm', $umkm->deskripsi_umkm) }}</textarea>
                                            @if ($errors->has('deskripsi_umkm'))
                                                <span class="text-danger">{{ $errors->first('deskripsi_umkm') }}</span>
                                            @endif
                                        </div>
                                        <div class="mt-3">
                                            <div class="mb-3">
                                                <label class="form-label">Foto UMKM 1:1</label>
                                                <input type="file"
                                                    class="form-control @error('image') is-invalid @enderror"
                                                    name="image">
                                                @if ($errors->has('image'))
                                                    <span class="text-danger">{{ $errors->first('image') }}</span>
                                                @endif
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-12">
                                                    <button type="submit"
                                                        class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Simpan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
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
                                {{ $umkm->owner->namalengkap }}
                            </div>
                        </div>
                        <div class="mt-4">
                            <h6 style="font-weight: bold">No Handphone</h6>
                            <div class="fs-3 fw-semibold" style="margin-top: 3px">
                                {{ $umkm->owner->no_telp }}
                            </div>
                        </div>
                        <hr>
                        <div>
                            <a href="{{ route('kelolaumkm.index') }}"
                                class="btn btn-sm btn-dark py-2 w-100 rounded-2 fs-4">Kembali</a>
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
