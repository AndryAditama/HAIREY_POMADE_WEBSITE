@extends("layout/template_customer")

@section("content_customer")

<div class="row">
    <?php

    use Illuminate\Support\Facades\DB;

    ?>
    @foreach($product as $row)
    <?php
    $getImgProduct = DB::table('product_images')->where('produk_id', $row->id_produk)->get();
    ?>
    <div class="col-sm-6 col-md-6 col-lg-3">
        <article class="article" style="border-radius: 10px; overflow: hidden; box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);">
            <div class="article-header">
                <a href="/detail_product/{{$row->id_produk}}">
                    <div class="article-image" data-background="{{ asset('/img/product/'. $getImgProduct[0]->gambar) }}"></div>
                </a>
                {{-- <div class="article-badge">
                    <div class="article-badge-item bg-danger">
                        <i class="fas fa-fire"></i> Top 1 Pomade
                    </div>
                </div> --}}
            </div>
            <div class="article-details">
                <h5>{{$row->nama_produk}}</h5>
                <div class="d-flex">
                   <h6>Rp. {{number_format($row->harga)}}</h6>
                   <span class="text-secondary ml-2" style="margin-top: -3px">{{$row->nama_kategori}}</span>
                   
                </div>
                <p>Terjual : 10</p>
                {{-- <div class="article-cta">
                    <a href="#" class="btn btn-primary"><i class="fas fa-cart-plus"></i> Tambah Ke Keranjang</a>
                </div> --}}
            </div>
        </article>
    </div>
    @endforeach
</div>

@endsection