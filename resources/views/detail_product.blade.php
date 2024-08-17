@extends("layout/template_customer")

@section("content_customer")

<style>
    /*****************globals*************/
    body {
        font-family: 'open sans, helvetica neue', helvetica, arial, sans-serif;
        overflow-x: hidden;
    }

    img {
        max-width: 100%;
    }

    .preview {
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -webkit-flex-direction: column;
        -ms-flex-direction: column;
        flex-direction: column;
    }

    @media screen and (max-width: 996px) {
        .preview {
            margin-bottom: 20px;
        }
    }

    .preview-pic {
        -webkit-box-flex: 1;
        -webkit-flex-grow: 1;
        -ms-flex-positive: 1;
        flex-grow: 1;
    }

    .preview-thumbnail.nav-tabs {
        border: none;
        margin-top: 15px;
    }

    .preview-thumbnail.nav-tabs li {
        width: 18%;
        margin-right: 2.5%;
    }

    .preview-thumbnail.nav-tabs li img {
        max-width: 100%;
        display: block;
    }

    .preview-thumbnail.nav-tabs li a {
        padding: 0;
        margin: 0;
    }

    .preview-thumbnail.nav-tabs li:last-of-type {
        margin-right: 0;
    }

    .tab-content {
        overflow: hidden;
    }

    .tab-content img {
        width: 100%;
        -webkit-animation-name: opacity;
        animation-name: opacity;
        -webkit-animation-duration: .3s;
        animation-duration: .3s;
    }

    .card-detail-product {
        background: #eee;
        padding: 3em;
        line-height: 1.5em;
    }

    @media screen and (min-width: 997px) {
        .wrapper {
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
        }
    }

    .details {
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -webkit-flex-direction: column;
        -ms-flex-direction: column;
        flex-direction: column;
    }

    .colors {
        -webkit-box-flex: 1;
        -webkit-flex-grow: 1;
        -ms-flex-positive: 1;
        flex-grow: 1;
    }

    .product-title,
    .price,
    .sizes,
    .colors {
        text-transform: capitalize;
        font-weight: bold;
    }

    .checked,
    .price span {
        color: #ff9f1a;
    }

    .product-title,
    .rating,
    .product-description,
    .price,
    .vote,
    .sizes {
        margin-bottom: 15px;
    }

    .product-title {
        margin-top: 0;
    }

    .size {
        margin-right: 10px;
    }

    .size:first-of-type {
        margin-left: 40px;
    }

    .color {
        display: inline-block;
        vertical-align: middle;
        margin-right: 10px;
        height: 2em;
        width: 2em;
        border-radius: 2px;
    }

    .color:first-of-type {
        margin-left: 20px;
    }

    .add-to-cart,
    .like {
        background: #ff9f1a;
        padding: 1.2em 1.5em;
        border: none;
        text-transform: UPPERCASE;
        font-weight: bold;
        color: #fff;
        -webkit-transition: background .3s ease;
        transition: background .3s ease;
    }

    .add-to-cart:hover,
    .like:hover {
        background: #b36800 !important;
        color: #fff;
    }

    .not-available {
        text-align: center;
        line-height: 2em;
    }

    .not-available:before {
        font-family: fontawesome;
        content: "\f00d";
        color: #fff;
    }

    .orange {
        background: #ff9f1a;
    }

    .green {
        background: #85ad00;
    }

    .blue {
        background: #0076ad;
    }

    .tooltip-inner {
        padding: 1.3em;
    }

    @-webkit-keyframes opacity {
        0% {
            opacity: 0;
            -webkit-transform: scale(3);
            transform: scale(3);
        }

        100% {
            opacity: 1;
            -webkit-transform: scale(1);
            transform: scale(1);
        }
    }

    @keyframes opacity {
        0% {
            opacity: 0;
            -webkit-transform: scale(3);
            transform: scale(3);
        }

        100% {
            opacity: 1;
            -webkit-transform: scale(1);
            transform: scale(1);
        }
    }

    /*# sourceMappingURL=style.css.map */
</style>

<div class="card card-detail-product">
    <div class="container-fliud">
      <a href="/home" class="btn btn-warning">Kembali</a>
        <div class="wrapper row">
            <div class="preview col-md-6">
                <div class="preview-pic tab-content">
                    <div class="tab-pane active" id="pic-1">
                        <img src="{{ asset('/img/product/'.$product_image[0]->gambar) }}"  width="300" height="500" style="object-fit: cover"/>
                    </div>
                    @foreach($product_image as $key => $row)
                    @unless($key == 0)
                    <div class="tab-pane" id="pic-{{ $key + 1 }}">
                        <img src="{{ asset('/img/product/'. $row->gambar) }}" width="300" height="500" style="object-fit: cover"/>
                    </div>
                    @endunless
                    @endforeach
                </div>
                <ul class="preview-thumbnail nav nav-tabs">
                    <li><a data-target="#pic-1" data-toggle="tab"><img src="{{asset('/img/product/'.$product_image[0]->gambar)}}"/></a></li>
                    @foreach($product_image as $key => $row)
                    @unless($key == 0)
                    <li><a data-target="#pic-{{ $key + 1 }}" data-toggle="tab"><img src="{{ asset('/img/product/'. $row->gambar) }}"/></a></li>
                    @endunless
                    @endforeach
                </ul>
            </div>
            <div class="details col-md-6">
                <h3 class="product-title">{{$product->nama_produk}}</h3>
                {{-- <span class="review-no"><i class="fas fa-eye"></i> 1000 Di Lihat</span>
                <div class="rating">
                    <div class="stars">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                    </div>
                    <p class="vote"><strong>80%</strong> Menilai barang ini dari <strong>(87 votes)</strong></p>
                </div> --}}
                <h4 class="price">Rp : <span id="hargaBarang" data-harga_barang="{{$product->harga}}">{{number_format($product->harga)}}</span></h4>
                <div class="d-flex justify-content-start">
                    <button type="button" class="btn btn-success" id="kurangiJml"><i class="fas fa-minus"></i></button>
                    <div class="px-2">
                        <input type="number" id="jumlah" class="form-control" style="width: 100px;" min="1" max="100" readonly>
                    </div>
                    <button type="button" class="btn btn-success" id="tambahJml"><i class="fas fa-plus"></i></button>
                </div>
                <div class="mt-2">
                    <h4 class="price">TOTAL : Rp. <span id="totalHarga">100,000</span></h4>
                </div>
                <div class="action mt-2">
                    <form action="/add_cart/{{$product->id_produk}}" class="d-inline" id="formAddToCart" method="post">
                        @csrf
                        <input type="hidden" name="jumlah" id="jumlah_produk" value="1">
                        <input type="hidden" name="total_harga" id="jumlah_total">
                        <button class="like btn btn-default" id="btnAddCart" type="submit"><span class="fa fa-cart-plus"></span> Tambah Ke Keranjang</button>
                    </form>
                </div>
                <div class="mt-2" style="height:260px; overflow-y: auto;"><strong>Deskripsi : </strong><br> {!! $product->deskripsi !!}</div>
            </div>
        </div>
    </div>
</div>

{{-- <div class="card">
    <div class="card-header">
        <h4>Komentar Dan Penilai Customer</h4>
    </div>
    <div class="card-body">
        <ul class="list-unstyled list-unstyled-border list-unstyled-noborder">
            <li class="media">
                <img alt="image" class="mr-3 rounded-circle" width="70" src="{{ asset('/template/assets/img/avatar/avatar-1.png') }}">
                <div class="media-body">
                    <div class="media-right">
                        <div class="text-secondary">
                            <div class="stars">
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                            </div>
                        </div>
                    </div>
                    <div class="media-title mb-1">Rizal Fakhri</div>
                    <div class="text-time">Yesterday</div>
                    <div class="media-description text-muted">Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum. <br>
                        <div class="gallery gallery-md">
                            <div class="gallery-item" data-image="{{ asset('/img/product/default.jpg') }}" data-title="Image 1"></div>
                        </div>
                    </div>
                </div>
            </li>
            <li class="media">
                <img alt="image" class="mr-3 rounded-circle" width="70" src="{{ asset('/template/assets/img/avatar/avatar-2.png') }}">
                <div class="media-body">
                    <div class="media-right">
                        <div class="text-warning">
                            <div class="text-secondary">
                                <div class="stars">
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="media-title mb-1">Bambang Uciha</div>
                    <div class="text-time">Yesterday</div>
                    <div class="media-description text-muted">Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
                </div>
            </li>
            <li class="media">
                <img alt="image" class="mr-3 rounded-circle" width="70" src="{{ asset('/template/assets/img/avatar/avatar-3.png') }}">
                <div class="media-body">
                    <div class="media-right">
                        <div class="text-primary">
                            <div class="text-secondary">
                                <div class="stars">
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="media-title mb-1">Ujang Maman</div>
                    <div class="text-time">Yesterday</div>
                    <div class="media-description text-muted">Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                        proident</div>

                </div>
            </li>
        </ul>
    </div>
</div> --}}

@endsection