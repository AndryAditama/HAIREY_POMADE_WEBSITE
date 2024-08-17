<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Edit Profil</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('/template/assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/template/assets/modules/fontawesome/css/all.min.css') }}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('/template/assets/modules/bootstrap-social/bootstrap-social.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('/template/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/template/assets/css/components.css') }}">
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- /END GA -->
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div
                        class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                        <div class="login-brand">
                            <img src="{{ asset('/template/assets/img/stisla-fill.svg') }}" alt="logo" width="100"
                                class="shadow-light rounded-circle">
                        </div>
                        <h4 class="text-center">HAIREY POMADE</h4>
                        <div class="py-2">
                            @if (session()->has('success'))
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert"
                                        aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-check"></i> Success!</h5>
                                    {{ session('success') }}
                                </div>
                            @elseif(session()->has('error'))
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert"
                                        aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                                    {{ session('error') }}
                                </div>
                            @endif
                        </div>
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Edit Profil</h4>
                            </div>

                            <div class="card-body">
                                <form method="POST" action="/update_profile/{{ $customer->id }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="form-group col-lg-6 col-md-12">
                                            <label for="nama_customer" class="d-block">Nama</label>
                                            <input type="text" id="nama_customer" name="nama_customer"
                                                class="form-control" value="{{ $customer->nama_customer }}">

                                        </div>
                                        <div class="form-group col-lg-6 col-md-12">
                                            <label for="alamat" class="d-block">Alamat</label>
                                            <input id="alamat" type="text" class="form-control" name="alamat"
                                                value="{{ $customer->alamat }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-6 col-md-12">
                                            <label for="nohp" class="d-block">No HP</label>
                                            <input id="nohp" type="number" class="form-control" name="no_hp"
                                                value="{{ $customer->no_hp }}">

                                        </div>

                                        <div class="form-group col-lg-6 col-md-12">
                                            <div class="preview-container mb-1" id="imgPreviewContainer">
                                                @if ($customer->gambar != 'default.jpg')
                                                    <img src="{{ asset('/img/customer/' . $customer->gambar) }}"
                                                        alt="default img" width="100" height="100" style="object-fit: cover">
                                                @else
                                                    <img src="{{ asset('/img/customer/default.jpg') }}"
                                                        alt="default img" width="100" height="100" style="object-fit: cover">
                                                @endif
                                            </div>
                                            <div>
                                                <small class="text-danger">( Max Size 2MB )</small>
                                            </div>
                                            <input type="file" name="gambar" id="inputImg"
                                                accept="image/jpg, image/jpeg, image/png">
                                            @error('gambar.*')
                                                <small class="text-danger">
                                                    {{ $message }}
                                                </small>
                                            @enderror

                                        </div>
                                    </div>


                                    <div class="form-divider">
                                        Inputan Untuk Login
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-6 col-md-12">
                                            <label for="email">Email</label>
                                            <input type="text" id="email" name="email" class="form-control"
                                                value="{{ $customer->email }}">
                                        </div>
                                        <div class="form-group col-lg-6 col-md-12">
                                            <label for="password">Password</label>
                                            <input type="password" id="password" name="password" class="form-control"
                                                placeholder="Password Baru (Opsional)">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                                            Update Profil
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="simple-footer">
                            Copyright &copy; Stisla 2018
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('/template/assets/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('/template/assets/modules/popper.js') }}"></script>
    <script src="{{ asset('/template/assets/modules/tooltip.js') }}"></script>
    <script src="{{ asset('/template/assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/template/assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('/template/assets/modules/moment.min.js') }}"></script>
    <script src="{{ asset('/template/assets/js/stisla.js') }}"></script>

    <!-- JS Libraies -->

    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="{{ asset('/template/assets/js/scripts.js') }}"></script>
    <script src="{{ asset('/template/assets/js/custom.js') }}"></script>
</body>

</html>
