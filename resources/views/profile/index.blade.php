@extends('template')
@section('title', 'Pasar Digital Darmasaba - My Profile')
@section('content')
<div class="container">
    <div class="card col-lg-4">
        <div class="card-body" style="margin-bottom: -28px">
            <form action="{{ route('profile.update', $umkm->owner->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div>
                    <h5>My Profile</h5>
                </div>
                <hr>
                <div class="mt-3">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Username</label>
                        <input type="username" class="form-control" id="username" name="username"
                            value="{{ old('username', $umkm->owner->username) }}">
                        @if ($errors->has('username'))
                            <span class="text-danger">{{ $errors->first('username') }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ old('email', $umkm->owner->email) }}">
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nama Lengkap</label>
                        <input type="namalengkap" class="form-control" id="namalengkap" name="namalengkap"
                            value="{{ old('namalengkap', $umkm->owner->namalengkap) }}">
                        @if ($errors->has('namalengkap'))
                            <span class="text-danger">{{ $errors->first('namalengkap') }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">No Handphone</label>
                        <input type="no_telp" class="form-control" id="no_telp" name="no_telp"
                            value="{{ old('no_telp', $umkm->owner->no_telp) }}">
                        @if ($errors->has('no_telp'))
                            <span class="text-danger">{{ $errors->first('no_telp') }}</span>
                        @endif
                    </div>
                    <div class="mt-3">
                        <hr>
                        <div class="row">
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-primary w-100 p-10 fs-4 mb-4 rounded-2">Simpan</button>
                            </div>
                            <div class="col-lg-6">
                                <a href="{{ route('kelolaumkm.index') }}" class="btn btn-dark p-10 w-100 rounded-2 fs-4">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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