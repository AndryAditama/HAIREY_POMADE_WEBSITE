@extends('layout/template_customer')

@section('content_customer')
    <?php
    
    use Carbon\Carbon;
    
    Carbon::setLocale('id');
    
    if ($transaksi->status == 'pending') {
        $bg = 'secondary';
    } elseif ($transaksi->status == 'process') {
        $bg = 'warning';
    } elseif ($transaksi->status == 'accepted') {
        $bg = 'success';
    } elseif ($transaksi->status == 'sending') {
        $bg = 'info';
    } elseif ($transaksi->status == 'cancel') {
        $bg = 'danger';
        # code...
    }
    ?>
    <div class="mb-2">
        <a href="/customer/transaksi" class="btn btn-primary btn-sm">Kembali</a>
    </div>
    <div class="row">
        <div class="col-sm-6">
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
                        <p class="text-danger fs-4">*Mohon upload bukti transfer untuk melanjutkan pesanan</p>
                        <img src="{{ asset('/img/bukti_transfer/' . $transaksi->bukti_transfer) }}" alt="img Bukti transfer"
                            width="200" class="img-thumbnail">
                        <form action="/customer/update/{{ $transaksi->id_transaksi }}" method="POST" enctype="multipart/form-data">
                           @csrf
                           @method('PUT')
                            <input type="file" name="gambar" id="inputImg"
                                accept="image/jpg, image/jpeg, image/png">
                            @error('gambar')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror

                            <button type="submit" class="btn btn-primary btn-sm mt-2">Upload</button>
                        </form>
                    </div>
                    <div class="mt-2">
                        <div class="text-left">
                            <h5>TOTAL : Rp. {{ number_format($transaksi->total) }}</h5>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card card-primary" style="height: 482px;">
                <div class="card-header font-weight-bold fs-2">
                    Tracking Pesanan
                </div>
                <div class="card-body" style="overflow-y: auto;">
                    <div class="row">
                        <div class="col-12">
                            <div class="activities">
                                @foreach ($tracking as $track)
                                    <?php
                                    if ($track->status == 'pending') {
                                        $bg = 'secondary';
                                        $message = 'Menunggu admin menkonfirmasi pesanan anda.';
                                        $icon = 'fa-regular fa-hourglass-half';
                                    } elseif ($track->status == 'process') {
                                        $bg = 'warning';
                                        $message = 'Pesanan anda sedang diproses.';
                                        $icon = 'fa-regular fa-box';
                                    } elseif ($track->status == 'accepted') {
                                        $bg = 'success';
                                        $message = 'Pesanan anda telah selesai.';
                                        $icon = 'fa-light fa-check';
                                    } elseif ($track->status == 'sending') {
                                        $bg = 'info';
                                        $message = 'Pesanan sedang dikirim.';
                                        $icon = 'fa-light fa-truck';
                                    } elseif ($track->status == 'cancel') {
                                        $bg = 'danger';
                                        $message = 'Pesanan anda dibatalkan.';
                                        $icon = 'fa-light fa-times';
                                    }
                                    ?>
                                    <div class="activity">
                                        <div
                                            class="activity-icon bg-{{ $bg }} text-white shadow-{{ $bg }}">
                                            <i class="fas {{ $icon }}"></i>
                                        </div>
                                        <div class="activity-detail">
                                            <div class="mb-2">
                                                <span class="text-job text-primary">{{ $track->status }}</span>
                                                <?php
                                                $date = $track->created_at;
                                                
                                                $date = Carbon::parse($date); // now date is a carbon instance
                                                $elapsed = $date->diffForHumans(Carbon::now());
                                                
                                                ?>
                                                <span class="bullet"></span>
                                                <span class="text-job">{{ $elapsed }}</span>

                                            </div>
                                            <p>{{ $message }}</p>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            Detail Produk
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
@endsection
