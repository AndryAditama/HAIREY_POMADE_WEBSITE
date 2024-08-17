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
                        
                        <th>No. Transaksi</th>
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
                    @foreach($history as $row)
                    <?php
                    $getImgProduct = DB::table('product_images')->where('produk_id', $row->produk_id)->get(); ?>
                    <tr>
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
                           <a href="/detail_product/{{$row->produk_id}}" class="btn btn-sm btn-success">Beli Lagi</a>
                            
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        </form>
    </div>
</div>

@endsection