@extends("layout/template")

@section("content")

<div class="mb-2">
    <a href="{{route('data_product.create')}}" class="btn btn-primary">Tambah Produk</a>
</div>
<div class="card">
    <div class="card-header">
        <h4>Basic DataTables</h4>
    </div>
    <div class="card-body">
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Gambar</th>
                    <th>Nama Produk</th>
                    <th>Nama Kategori</th>
                    <th>Stok</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <?php

            use Illuminate\Support\Facades\DB;
            ?>
            <tbody>
                @php
                $no = 1;
                @endphp
                @foreach($product as $row)
                <?php
                $getImgProduct = DB::table('product_images')->where('produk_id', $row->id_produk)->get();
                ?>
                <tr>
                    <td>{{$no++}}</td>
                    <td>
                        <div class="gallery">
                            <div class="gallery-item gallery-more" data-image="{{ asset('/img/product/'. $getImgProduct[0]->gambar) }}" data-title="Image 1">
                                <div>{{count($getImgProduct)}}+</div>
                            </div>
                            @foreach($getImgProduct as $rows)
                            <div class="gallery-item gallery-hide" data-image="{{ asset('/img/product/'. $rows->gambar) }}" data-title="Image 1"></div>
                            @endforeach
                        </div>
                    </td>
                    <td>{{$row->nama_produk}}</td>
                    <td>{{$row->nama_kategori}}</td>
                    <td>{{$row->stok}}</td>
                    <td>Rp. {{number_format($row->harga)}}</td>
                    <td>{{$row->status}}</td>
                    <td>
                        <a href="{{route('data_product.edit', $row->id_produk)}}" class="btn btn-sm btn-warning"><i class="fas fa-pen"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection