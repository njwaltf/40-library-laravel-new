<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        .invalid {
            color: red;
            font-stretch: 5pt;
        }

        /* Loading animation */
        .loader {
            border: 8px solid #f3f3f3;
            /* Light grey */
            border-top: 8px solid #6777ef;
            /* Blue */
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 2s linear infinite;
            margin: 0 auto;
            display: none;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Custom styles for preview images */
        .preview-image {
            display: none;
            max-width: 100%;
            margin-top: 10px;
            border: 2px solid #6777ef;
            border-radius: 5px;
        }
    </style>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Pengajuan akun 40 Library</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="assets/modules/bootstrap-social/bootstrap-social.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <!-- /END GA -->
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-8">
                        <div class="login-brand text-center">
                            <img src="{{ asset('assets/img/logo_login.png') }}" alt="logo" width="100"
                                class="shadow-light rounded-circle">
                        </div>
                        <div class="card card-primary">
                            <div class="card-header text-center">
                                <p style="font-size: 16pt;">Ajukan akun <strong>40 Library</strong></p>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="/apply" enctype="multipart/form-data">
                                    @csrf
                                    @if (session()->has('applyFail'))
                                        <div class="alert alert-danger alert-dismissible show fade">
                                            <div class="alert-body">
                                                <button class="close" data-dismiss="alert">
                                                    <span>&times;</span>
                                                </button>
                                                {{ session('applyFail') }}
                                            </div>
                                        </div>
                                    @endif
                                    @if (session()->has('applySuccess'))
                                        <div class="alert alert-success alert-dismissible show fade">
                                            <div class="alert-body">
                                                <button class="close" data-dismiss="alert">
                                                    <span>&times;</span>
                                                </button>
                                                {{ session('applySuccess') }}
                                            </div>
                                        </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="name">Nama</label>
                                                <input id="name" type="text"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    name="name" tabindex="1" autofocus
                                                    placeholder="Masukkan nama lengkap Anda"
                                                    value="{{ old('name') }}">
                                                @error('name')
                                                    <p class="invalid">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="username">Username</label>
                                                <input id="username" type="text"
                                                    class="form-control @error('username') is-invalid @enderror"
                                                    name="username" tabindex="2" placeholder="Masukkan username Anda"
                                                    value="{{ old('username') }}">
                                                @error('username')
                                                    <p class="invalid">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input id="email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    name="email" tabindex="3" placeholder="Masukkan email Anda"
                                                    value="{{ old('email') }}">
                                                @error('email')
                                                    <p class="invalid">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="id_no">Nomor Identitas NIP/NIS</label>
                                                <input id="id_no" type="text"
                                                    class="form-control @error('id_no') is-invalid @enderror"
                                                    name="id_no" tabindex="4"
                                                    placeholder="Masukkan nomor identitas Anda"
                                                    value="{{ old('id_no') }}">
                                                @error('id_no')
                                                    <p class="invalid">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input id="password" type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" tabindex="7" placeholder="Masukkan password">
                                                @error('password')
                                                    <p class="invalid">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="id_card_img">Foto Kartu Identitas (Landscape)</label>
                                                <input id="id_card_img" type="file"
                                                    class="form-control-file @error('id_card_img') is-invalid @enderror"
                                                    name="id_card_img" tabindex="5"
                                                    onchange="previewImage(this, 'id_card_img_preview')">
                                                <img id="id_card_img_preview" src="#" alt="Preview"
                                                    class="preview-image">
                                                @error('id_card_img')
                                                    <p class="invalid">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="identity_img">Foto Diri Dengan Kartu Identitas
                                                    (Landscape)</label>
                                                <input id="identity_img" type="file"
                                                    class="form-control-file @error('identity_img') is-invalid @enderror"
                                                    name="identity_img" tabindex="6"
                                                    onchange="previewImage(this, 'identity_img_preview')">
                                                <img id="identity_img_preview" src="#" alt="Preview"
                                                    class="preview-image">
                                                @error('identity_img')
                                                    <p class="invalid">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block"
                                            tabindex="8">
                                            Ajukan
                                        </button>
                                        <div class="loader"></div> <!-- Loading animation -->
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="mt-3 text-center">
                            Sudah punya akun? <a href="/">Masuk sekarang</a>
                        </div>
                        <div class="simple-footer text-muted text-center">
                            Copyright &copy; 40 Library 2024
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="assets/modules/jquery.min.js"></script>
    <script src="assets/modules/popper.js"></script>
    <script src="assets/modules/bootstrap/js/bootstrap.min.js"></script>
    <!-- JS Libraies -->
    <!-- Page Specific JS File -->
    <!-- Template JS File -->
    <script src="assets/js/scripts.js"></script>
    <script src="assets/js/custom.js"></script>

    <script>
        // Function to preview image
        function previewImage(input, previewId) {
            var preview = document.getElementById(previewId);
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onloadstart = function() {
                    $('.loader').show(); // Show loading animation
                };
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    $('.loader').hide(); // Hide loading animation
                }
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            } else {
                preview.src = '#';
                preview.style.display = 'none';
                $('.loader').hide(); // Hide loading animation
            }
        }
    </script>
</body>

</html>
