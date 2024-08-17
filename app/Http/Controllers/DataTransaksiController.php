<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataTransaksiController extends Controller
{
    //
    public function index()
    {
        $data_transaksi = DB::table('transaksis')
            ->select('*', 'transaksis.id AS id_transaksi')
            ->join('customers', 'customers.id', '=', 'transaksis.customer_id')
            ->get();

        $data = [
            'title' => 'Data Transaksi',
            'data_transaksi' => $data_transaksi
        ];

        return view('owner/data_transaksi', $data);
    }
}
