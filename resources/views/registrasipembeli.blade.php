<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Darmasaba Digital Market</title>
    <link rel="shortcut icon" type="image/png" href="../images/logo-damart-icon.png" />
    <link rel="stylesheet" href="../assets/css/styles.min.css" />
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div
        class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center"
        style="background-image: url('../images/bg-login-new1.png'); background-size: cover; background-position: center;">
        <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="/" class="text-nowrap text-center d-block py-3 w-100">
                                    <img src="../images/logo-damart-landscape.png" alt="" style="height: 80px;">
                                  </a>
                                {{-- <h4 style="font-weight: bold" class="text-center">Pasar Digital Darmasaba</h4> --}}
                                <form method="POST" action="{{ route('proses.registrasipembeli') }}">
                                    @csrf
                                    <div class="mt-3">
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Nama Lengkap</label>
                                            <input type="text" class="form-control" id="namalengkap" name="namalengkap" placeholder="Masukkan Nama Lengkap di sini">
                                            @if ($errors->has('namalengkap'))
                                                <span class="text-danger">{{ $errors->first('namalengkap') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email di sini">
                                            @if ($errors->has('email'))
                                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Username</label>
                                            <input type="username" class="form-control" id="username" name="username" placeholder="Masukkan Username di sini">
                                            @if ($errors->has('username'))
                                                <span class="text-danger">{{ $errors->first('username') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                          <label for="exampleInputEmail1" class="form-label">Nomor Telepon</label>
                                          <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="Masukkan Nomor Telepon di sini">
                                          @if ($errors->has('no_telp'))
                                              <span class="text-danger">{{ $errors->first('no_telp') }}</span>
                                          @endif
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Alamat</label>
                                            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan Alamat  di sini">
                                            @if ($errors->has('alamat'))
                                                <span class="text-danger">{{ $errors->first('alamat') }}</span>
                                            @endif
                                          </div>
                                        <div class="mb-4">
                                            <label for="exampleInputPassword1" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkkan Password di sini">
                                            @if ($errors->has('password'))
                                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                            @endif
                                        </div>
                                        <button type="submit"
                                        class="btn w-100 py-8 fs-4 mb-4 rounded-2" style="background: linear-gradient(to right, #66D9EF, #8AEF74); color: white; border: none;">Daftar</button>
                                       <div class="d-flex align-items-center justify-content-center">
                                            <p class="fs-4 mb-0 fw-bold">Sudah Punya Akun?</p>
                                            <a class="text-primary fw-bold ms-2" href="{{ route('login') }}">Login</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="../assets/libs/jquery/dist/jquery.min.js"></script>
<script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

</html>
