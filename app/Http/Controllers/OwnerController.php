<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OwnerController extends Controller
{
   //
   public function dashboard()
   {
      $auth = Auth::user();

      // hitung jumlah customer dengan role 2
      $countCustomer = DB::table('users')->where('role', 2)->count();
      $countProduct = DB::table('products')->count();
      $countTransaksiPending = DB::table('transaksis')->where('status', 'pending')->count();
      $countAllTransaksi = DB::table('transaksis')->count();
      // dd($getCustomer);

      $data = [
         'title' => 'Dashboard',
         'customer' => $countCustomer,
         'product' => $countProduct,
         'transaksi_pending' => $countTransaksiPending,
         'transaksi_all' => $countAllTransaksi
      ];

      return view('owner/dashboard', $data);
   }
}
