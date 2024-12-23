@extends('template')
@section('title', 'Pasar Digital Darmasaba - My Profile')
@section('content')
<div class="card  col-lg-5">
    <div class="card-body">
        <form action="{{ route('profile.update', $owner->id) }}" method="POST" enctype="multipart/form-data">

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
                        value="{{ old('username', $owner->username) }}">
                    @if ($errors->has('username'))
                        <span class="text-danger">{{ $errors->first('username') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email"
                        value="{{ old('email', $owner->email) }}">
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nama Lengkap</label>
                    <input type="namalengkap" class="form-control" id="namalengkap" name="namalengkap"
                        value="{{ old('namalengkap', $owner->namalengkap) }}">
                    @if ($errors->has('namalengkap'))
                        <span class="text-danger">{{ $errors->first('namalengkap') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">No Handphone</label>
                    <input type="no_telp" class="form-control" id="no_telp" name="no_telp"
                        value="{{ old('no_telp', $owner->no_telp) }}">
                    @if ($errors->has('no_telp'))
                        <span class="text-danger">{{ $errors->first('no_telp') }}</span>
                    @endif
                </div>
                <div class="mt-3">
                    <hr>
                    <div class="row">
                        <div class="col-lg-6">
                            <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Simpan</button>
                        </div>
                        <div class="col-lg-6">
                            <a href="{{ route('kelolaumkm.index') }}" class="btn btn-sm btn-dark py-8 w-100 rounded-2 fs-4">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection