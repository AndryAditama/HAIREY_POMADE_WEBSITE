@extends('layout/template')

@section('content')
    <a href="/data_transaksi" class="btn btn-primary btn-sm">Kembali</a>
    <div class="py-2">


        <?php
        
        use Carbon\Carbon;
        
        if ($transaksi->status == 'pending') {
            $bg = 'secondary';
        } elseif ($transaksi->status == 'process') {
            $bg = 'warning';
        } elseif ($transaksi->status == 'accepted') {
            $bg = 'info';
        } elseif ($transaksi->status == 'sending') {
            $bg = 'success';
        } elseif ($transaksi->status == 'cancel') {
            $bg = 'danger';
        }
        ?>
        <div class="card card-{{ $bg }}">
            <div class="card-header d-flex justify-content-between">
                <h4>STATUS : <span style="text-transform: uppercase;" class="text-{{ $bg }}"><i
                            class="far fa-clock"></i> {{ $transaksi->status }}</span></h4>
                <?php
                $tanggal = Carbon::createFromFormat('Y-m-d', $transaksi->tanggal);
                ?>
                <h4><i class="fas fa-calendar"></i> <?php echo $tanggal->translatedFormat('l, j F Y'); ?></h4>
            </div>
            <div class="card-body">
                <table>
                    <tr>
                        <th>KODE TRANSAKSI</th>
                        <th class="px-2">:</th>
                        <td>{{ $transaksi->kode_transaksi }}</td>
                    </tr>
                    <tr>
                        <th>JUMLAH BARANG</th>
                        <th class="px-2">:</th>
                        <td>{{ $transaksi->jumlah_barang }}</td>
                    </tr>
                </table>
                <div class="mt-2">
                    <p>Bukti Tansfer :</p>
                    <div class="gallery">
                        <div class="gallery-item" style="width: 200px; height: 200px; overflow: hidden;"
                            data-image="{{ asset('/img/bukti_transfer/' . $transaksi->bukti_transfer) }}"
                            data-title="Image {{ $transaksi->bukti_transfer }}">
                            
                        </div>
                    </div>
                </div>
                <div class="mt-2">
                    <div class="text-right">
                        <h5>TOTAL :</h5>
                        <h5>Rp. {{ number_format($transaksi->total) }}</h5>
                    </div>
                </div>
                <div class="d-flex justify-content-start mt-2" style="overflow-x: auto;">
                    <form action="/proses_transaksi/{{ $transaksi->id_transaksi }}" method="post">
                        @csrf
                        <input type="hidden" name="customer_id" id="" value="{{ $transaksi->customer_id }}">
                        <input type="hidden" name="status" id="" value="process">
                        <button type="submit" class="btn btn-info">Proses Pesanan</button>
                    </form>
                    <div class="px-2">
                        <form action="/proses_transaksi/{{ $transaksi->id_transaksi }}" method="post">
                            @csrf
                            <input type="hidden" name="customer_id" id="" value="{{ $transaksi->customer_id }}">
                            <input type="hidden" name="status" id="" value="sending">
                            <button type="submit" class="btn btn-success">Pesanan Dikirim</button>
                        </form>
                    </div>
                    <form action="/proses_transaksi/{{ $transaksi->id_transaksi }}" method="post">
                        @csrf
                        <input type="hidden" name="customer_id" id="" value="{{ $transaksi->customer_id }}">
                        <input type="hidden" name="status" id="" value="cancel">
                        <button type="submit" class="btn btn-danger">Batalkan Pesanan</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-header">
                        <strong>Profil Customer</strong>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="{{ asset('/img/customer/' . $transaksi->gambar) }}" alt="Profile"
                                class="rounded-circle" width="150" height="150" style="object-fit: cover;">
                            <div class="mt-3">
                                <h4>{{ $transaksi->nama_customer }}</h4>
                                <p class="text-primary mb-1"><i class="fas fa-phone"></i> : 0{{ $transaksi->no_hp }}</p>
                                <p class="text-muted font-size-sm">{{ $transaksi->alamat }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="card">
                    <div class="card-header">
                        <h4>Detail Produk</h4>
                    </div>
                    <div class="card-body">
                        <table id="example" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Gambar</th>
                                    <td>Nama Produk</td>
                                    <td>Kategori</td>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Total Harga</th>
                                </tr>
                            </thead>
                            <?php
                            
                            use Illuminate\Support\Facades\DB;
                            ?>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($detail as $row)
                                    <?php
                                    $getImgProduct = DB::table('product_images')
                                        ->where('produk_id', $row->id_produk)
                                        ->get();
                                    ?>
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td><img src="{{ asset('/img/product/' . $getImgProduct[0]->gambar) }}"
                                                alt="bukti transfer img" width="80"></td>
                                        <td>{{ $row->nama_produk }}</td>
                                        <td>{{ $row->nama_kategori }}</td>
                                        <td>Rp. {{ number_format($row->harga) }}</td>
                                        <td>{{ $row->jumlah }}</td>
                                        <td>Rp. {{ number_format($row->total_harga) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    @endsection
