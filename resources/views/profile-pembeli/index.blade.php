@extends('templatemenu')

@section('title', 'Darmasaba Digital Market - Profile')

@section('content')
<div class="container mt-5">
    <div class="row gy-3">
        <div class="col-md-12 col-lg-6">
            <div class="card card-white">
                <div class="text-white text-center">
                    <h3>Profile</h3>
                </div>
                <div class="card-body">
                    <div class="hr-dashed mb-3"></div>
                    <table class="table table-borderless table-responsive">
                        <tr>
                            <th>Nama</th>
                            <td>:</td>
                            <td>{{ $pembeli->namalengkap }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>:</td>
                            <td>{{ $pembeli->email }}</td>
                        </tr>
                        <tr>
                            <th>Nomor HP</th>
                            <td>:</td>
                            <td>{{ $pembeli->no_telp }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>:</td>
                            <td>{{ $pembeli->alamat }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
         <!-- Form Edit Profile -->
         <div class="col-md-12 col-lg-6">
            <div class="card card-white shadow-sm">
                <div class="text-center">
                    <h3>Edit Profile</h3>
                </div>
                <div class="card-body">
                    <div class="hr-dashed mb-3"></div>
                    <form action="{{ route('profile.pembeli.update', $pembeli->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="namalengkap" value="{{ $pembeli->namalengkap }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $pembeli->email }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="no_telp" class="form-label">Nomor HP</label>
                            <input type="text" class="form-control" id="no_telp" name="no_telp" value="{{ $pembeli->no_telp }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="2" required>{{ $pembeli->alamat }}</textarea>
                        </div>
                        <div class="hr-dashed"></div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="text-center mt-3">
                                    <button type="submit" class="btn btn-success w-100">Simpan</button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="text-center mt-3">
                                    <a href="{{route('home')}}" class="btn btn-primary w-100">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </form>
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