@extends("layout/template_customer")

@section("content_customer")
<div class="card">
    <div class="card-header">
        <h4>Basic DataTables</h4>
    </div>
    <div class="card-body">
        <form action="/checkout" method="post">
            @csrf
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="selectAll"></th>
                        <th>NO</th>
                        <th>Gambar</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    use Illuminate\Support\Facades\DB;
                    ?>
                    @php $no = 1; @endphp
                    @foreach($cart as $row)
                    <?php
                    $getImgProduct = DB::table('product_images')->where('produk_id', $row->id_produk)->get(); ?>
                    <tr>
                        <td><input type="checkbox" class="productCheckbox" name="id_keranjang[]" value="{{$row->id_keranjang}}"></td>
                        <td>{{$no++}}</td>
                        <td>
                            <div class="gallery">
                                <div class="gallery-item gallery-more" data-image="{{ asset('/img/product/'. $getImgProduct[0]->gambar) }}" data-title="Image {{$getImgProduct[0]->gambar}}">
                                    <div>{{count($getImgProduct)}}+</div>
                                </div>
                                @foreach($getImgProduct as $rows)
                                <div class="gallery-item gallery-hide" data-image="{{ asset('/img/product/'. $rows->gambar) }}" data-title="Image {{$rows->gambar}}"></div>
                                @endforeach
                            </div>
                        </td>
                        <td>{{$row->nama_produk}}</td>
                        <td>Rp. {{number_format($row->harga)}}</td>
                        <td>{{$row->jumlah}} <input type="hidden" name="jumlah[]" id="" value="{{$row->jumlah}}"></td>
                        <td>Rp. {{number_format($row->total_harga)}} <input type="hidden" name="total_harga[]" value="{{$row->total_harga}}"></td>
                        <td>
                            <a href="/drop_cart/{{$row->id_keranjang}}" class="d-inline btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-right">
                <h3>Total <span id="cartTotal">Rp. 0</span></h3>
                <div class="mt-2">
                    <button type="submit" id="btnCheckout" class="btn btn-success">Checkout</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection