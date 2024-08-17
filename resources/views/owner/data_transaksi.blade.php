@extends('layout/template')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Basic DataTables</h4>
        </div>
        <div class="card-body">
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>NO</th>
                        <td>Bukti Transfer</td>
                        <td>Nama Customer</td>
                        <th>Kode Transaksi</th>
                        <th>Jumlah Barang</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;

                    @endphp

                    @foreach ($data_transaksi as $row)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td><img src="{{ asset('/img/bukti_transfer/' . $row->bukti_transfer) }}" alt="bukti transfer img"
                                    width="80"></td>
                            <td>{{ $row->nama_customer }}</td>
                            <td>{{ $row->kode_transaksi }}</td>
                            <td>{{ $row->jumlah_barang }}</td>
                            <td>Rp. {{ number_format($row->total) }}</td>

                            @php
                                if ($row->status == 'pending') {
                                    $bg = 'secondary';
                                } elseif ($row->status == 'process') {
                                    $bg = 'warning';
                                } elseif ($row->status == 'accepted') {
                                    $bg = 'success';
                                } elseif ($row->status == 'sending') {
                                    $bg = 'info';
                                } elseif ($row->status == 'cancel') {
                                    $bg = 'danger';
                                    # code...
                                }
                            @endphp

                            <td class="p-2 text-white text-center font-weight-bold">
                              <span class="bg-{{ $bg }} px-2 py-1 rounded">{{ $row->status }}</span></td>
                            <td>
                                <a href="/detail_transaksi/{{ $row->id_transaksi }}" class="btn btn-sm btn-info">Detail
                                    Transaksi</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
