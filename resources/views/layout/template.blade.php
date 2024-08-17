<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>HAIREY POMADE / {{ $title }}</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('/template/assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/template/assets/modules/fontawesome/css/all.min.css') }}">

    <!-- CSS Libraries -->
    
    <link rel="stylesheet" href="{{ asset('/template/datatables/datatables.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="{{ asset('/template/assets/modules/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('/template/assets/modules/chocolat/dist/css/chocolat.css') }}">
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
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                    </ul>

                </form>
                <ul class="navbar-nav navbar-right">
                    
                    
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            {{-- <img alt="image" src="{{ asset('/img/customer/'.session()->get('image')) }}" class="rounded-circle mr-1"> --}}
                            <div class="d-sm-none d-lg-inline-block">{{ Auth::user()->name }}</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            {{-- <a href="features-profile.html" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Profile
                            </a> --}}
                           
                            <div class="dropdown-divider"></div>
                            <a href="/logout" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar sidebar-style-2">
                @include('layout/sidebar');
            </div>

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>{{$title}}</h1>
                    </div>
                    <div class="section-body">
                        <div class="py-2">
                            @if(session()->has('success'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h5><i class="icon fas fa-check"></i> Success!</h5>
                                {{session('success')}}
                            </div>
                            @elseif(session()->has('error'))
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h5><i class="icon fas fa-ban"></i> Error!</h5>
                                {{session('error')}}
                            </div>
                            @endif
                        </div>
                        @yield('content')
                    </div>
                </section>
            </div>
            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad Nauval Azhar</a>
                </div>
                <div class="footer-right">

                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    
    <script src="{{ asset('/template/assets/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('/template/assets/modules/popper.js') }}"></script>
    <script src="{{ asset('/template/assets/modules/tooltip.js') }}"></script>
    <script src="{{ asset('/template/assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/template/assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('/template/assets/modules/moment.min.js') }}"></script>
    <script src="{{ asset('/template/assets/js/stisla.js') }}"></script>
    <script src="{{ asset('/template/assets/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
    <script src="{{ asset('/template/datatables/datatables.js') }}"></script>
    <script src="{{ asset('/template/assets/modules/summernote/summernote-bs4.js') }}"></script>
    <!-- Template JS File -->
    <script src="{{ asset('/template/assets/js/scripts.js') }}"></script>
    <script src="{{ asset('/template/assets/js/custom.js') }}"></script>
    
    <script>
        document.getElementById('rupiah').addEventListener('input', function(e) {
            let value = e.target.value.replace(/[^,\d]/g, '').toString();
            let split = value.split(',');
            let sisa = split[0].length % 3;
            let rupiah = split[0].substr(0, sisa);
            let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            e.target.value = rupiah;
        });
    </script>
    <script>
        new DataTable('#example', {
            paging: true,
            scrollCollapse: true,
            scrollY: '50vh'
        });

        $(function() {
            var url = window.location;
            // for single sidebar menu
            $('ul.sidebar-menu').filter(function() {
                return this.href == url;
            }).addClass('active');

            // for sidebar menu and treeview
            $('ul.nav-treeview a').filter(function() {
                    return this.href == url;
                }).parentsUntil(".nav-sidebar > .nav-treeview")
                .css({
                    'display': 'block'
                })
                .addClass('menu-open').prev('a')
                .addClass('active');
        });

        $(document).ready(function() {
            $('#inputImg').change(function() {
                const input = this;
                if (input.files) {
                    $('#imgPreviewContainer').empty();
                    $.each(input.files, function(index, file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const img = $('<img>').attr('src', e.target.result);
                            $('#imgPreviewContainer').append(img);
                        }
                        reader.readAsDataURL(file);
                    });
                }
            });

            //Event form kategori
            $("#btnSimpanKategori").hide();
            $("#btnBatalSimpanKategori").hide();
            $("#nama_kategori").attr('readonly', true);
            $("#btnTambahKategori").click(function() {
                $("#btnSimpanKategori").show();
                $("#btnBatalSimpanKategori").show();
                $("#btnTambahKategori").hide();
                $("#nama_kategori").val('');

                $("#nama_kategori").attr('readonly', false);
                $("#nama_kategori").focus();
            })
            $("#btnBatalSimpanKategori").click(function() {
                $("#btnSimpanKategori").hide();
                $("#btnBatalSimpanKategori").hide();
                $("#nama_kategori").attr('readonly', true);
                $("#nama_kategori").val('');

                $("#btnTambahKategori").show();
            })

            //AJAX 
            //add to chart

        });
    </script>
</body>

</html>