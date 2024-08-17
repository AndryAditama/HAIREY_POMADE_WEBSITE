@extends("layout/template_customer")

@section("content_customer")
<?php

use Carbon\Carbon;

Carbon::setLocale('id');
?>
<div class="text-right mb-2">
    <a href="" class="btn btn-primary"><i class="fas fa-sync"></i> Refresh</a>
</div>
@if(count($transaksi) != 0)
@foreach($transaksi as $row)
<?php
if ($row->status == 'pending') {
    $bg = 'secondary';
} else if ($row->status == 'process') {
    $bg = 'warning';
} elseif ($row->status == 'accepted') {
    $bg = 'info';
} elseif ($row->status == 'sending') {
    $bg = 'success';
} elseif ($row->status == 'cancel') {
     $bg = 'danger';
}
?>
<div class="card card-{{$bg}}">
    <div class="card-header d-flex justify-content-between">
        <h4>STATUS : <span style="text-transform: uppercase;" class="text-{{$bg}}"><i class="far fa-clock"></i> {{$row->status}}</span></h4>
        <?php
        $tanggal = Carbon::createFromFormat('Y-m-d', $row->tanggal);
        ?>
        <h4><i class="fas fa-calendar"></i> <?php echo $tanggal->translatedFormat('l, j F Y'); ?></h4>
    </div>
    <div class="card-body">
        <table>
            <tr>
                <th>KODE TRANSAKSI</th>
                <th class="px-2">:</th>
                <td>{{$row->kode_transaksi}}</td>
            </tr>
            <tr>
                <th>JUMLAH BARANG</th>
                <th class="px-2">:</th>
                <td>{{$row->jumlah_barang}}</td>
            </tr>
        </table>
        <div class="mt-2">
            <div class="text-right">
                <h5>TOTAL :</h5>
                <h5>Rp. {{number_format($row->total)}}</h5>
            </div>
        </div>
        <div class="mt-2">
            <a href="/customer/detail_transaksi/{{$row->id}}" class="btn btn-primary">Detail</a>
        </div>
    </div>
</div>
@endforeach
@else
<div class="text-center">
    <img src="https://cdni.iconscout.com/illustration/premium/thumb/no-transaction-7359562-6024630.png" alt="" width="200">
    <h4>Tidak ada transaksi</h4>
</div>
@endif

@endsection