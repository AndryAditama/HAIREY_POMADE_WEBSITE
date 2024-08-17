<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>HAIREY POMADE</title>

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


</head>

<body class="layout-3">
    <div id="app">
        <div class="main-wrapper container">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <a href="/home" class="navbar-brand sidebar-gone-hide">HAIREY POMADE</a>
                <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
                <div class="nav-collapse">
                    <a class="sidebar-gone-show nav-collapse-toggle nav-link" href="#">
                        <i class="fas fa-ellipsis-v"></i>
                    </a>
                </div>
                
                @if(session()->get('logged_in') == true)
                <ul class="navbar-nav navbar-right d-inline ml-auto">
                    
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">

                            <img alt="image" src="{{ asset('/img/customer/'. session()->get('image'))}}" class="rounded-circle mr-1" style="width: 35px; height: 35px; object-fit: cover">
                            <div class="d-sm-none d-lg-inline-block">Hi, {{session()->get('name')}}</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="/edit_profile/{{session()->get('id')}}" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="/logout" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
                @else
                <div class="pl-2">
                    <a href="/login" class="btn btn-success"><i class="fas fa-sign-in-alt"></i> Login</a>
                </div>
                @endif
            </nav>

            <nav class="navbar navbar-secondary navbar-expand-lg">
                <div class="container">
                    @include('layout/navbar_customer')
                </div>
            </nav>

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>{{$title}}</h1>
                        <div class="section-header-breadcrumb">
                            <div class="breadcrumb-item active"><a href="#">{{$title}}</a></div>
                            <div class="breadcrumb-item"><a href="/home">Home</a></div>
                        </div>
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
                        @yield('content_customer')
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        new DataTable('#example', {
            paging: true,
            scrollCollapse: true,
            scrollY: '50vh'
        });
        $(document).ready(function() {
            //AJAX
            //Add to cart
            console.log('test');
            $("#btnAddCart").click(function(e) {
                e.preventDefault();
                console.log('test');
                Swal.fire({
                    title: "Tambah Produk Ke Keranjang ?",
                    text: "Total harga dari " + $("#jumlah").val() + " produk sebesar " + $("#totalHarga").text(),
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya. Tambahkan Ke Keranjang",
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $("#formAddToCart").submit();
                    }
                });
            })
            let jumlah = 1; // Memulai dengan jumlah 1
            $("#jumlah").val(jumlah);

            function formatRupiah(angka) {
                let rupiah = '';
                let angkarev = angka.toString().split('').reverse().join('');
                for (let i = 0; i < angkarev.length; i++) {
                    if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';
                }
                return 'Rp. ' + rupiah.split('', rupiah.length - 1).reverse().join('');
            }

            function updateTotalHarga() {
                let harga_barang = $("#hargaBarang").data("harga_barang");
                let total_harga = harga_barang * jumlah;
                console.log(total_harga);
                $("#totalHarga").text(formatRupiah(total_harga));
                $("#jumlah_total").val(total_harga);
            }

            //event calculate data cart
            $('#selectAll').on('change', function() {
                $('.productCheckbox').prop('checked', this.checked);
                calculateTotal();
            });

            $('.productCheckbox').on('change', function() {
                if ($('.productCheckbox:checked').length === $('.productCheckbox').length) {
                    $('#selectAll').prop('checked', true);
                } else {
                    $('#selectAll').prop('checked', false);
                }
                calculateTotal();
            });

            function calculateTotal() {
                let total = 0;
                $('.productCheckbox:checked').each(function() {
                    total += parseFloat($(this).closest('tr').find('input[name="total_harga[]"]').val());
                });
                $('#cartTotal').text(formatRupiah(total));
            }

            // Tambah Jumlah
            $("#tambahJml").click(function() {
                jumlah++;
                $("#jumlah").val(jumlah); // Set nilai jumlah yang baru
                $("#jumlah_produk").val(jumlah);
                updateTotalHarga();
            });

            // Kurang Jumlah
            $("#kurangiJml").click(function() {
                if (jumlah > 1) {
                    jumlah--;
                }
                $("#jumlah").val(jumlah); // Set nilai jumlah yang baru
                updateTotalHarga();
            });

            // Set initial total harga
            updateTotalHarga();
        })
    </script>
</body>

</html>