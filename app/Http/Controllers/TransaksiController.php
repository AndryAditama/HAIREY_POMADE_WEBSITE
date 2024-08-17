<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\DetailTransaksi;
use App\Models\TimeLinePesanan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
   //
   public function getCustomer()
   {
      $getCustomer = Customer::where('user_id', session()->get('id'))->first();
      return $getCustomer;
   }
   public function checkout(Request $request)
   {
      $id_keranjang = $request->id_keranjang;

      $jml_barang = count($id_keranjang);

      $jumlah_barang = 0;
      $total_harga = 0;
      for ($i = 0; $i < $jml_barang; $i++) {
         $jumlah_barang += $request->jumlah[$i];
         $total_harga += $request->total_harga[$i];
      }
      $create_transaksi =  Transaksi::create([
         'customer_id' => $this->getCustomer()->id,
         'kode_transaksi' => "TR" . date('ymd') . rand(1000, 9999),
         'jumlah_barang' => $jumlah_barang,
         'total' => $total_harga,
         'tanggal' => Carbon::today(),
         'bukti_transfer' => 'default.jpg',
         'status' => 'pending'
      ]);

      $create_timeline = TimeLinePesanan::create([
         'transaksi_id' => $create_transaksi->id,
         'customer_id' => $this->getCustomer()->id,
         'status' => 'pending',
         'tanggal' => Carbon::today(),
      ]);

      for ($is = 0; $is < $jml_barang; $is++) {
         $getCart = Cart::findOrFail($id_keranjang[$is]);
         DetailTransaksi::create([
            'transaksi_id' => $create_transaksi->id,
            'produk_id' => $getCart->produk_id,
            'jumlah' => $getCart->jumlah,
            'total_harga' => $getCart->total_harga
         ]);

         $getCart->delete();
      }

      return redirect('/customer/transaksi')->with('success', 'Transaksi berhasil dilakukan');
   }

   public function transaksi()
   {
      // select transaksi berdasarkan customer dan update terbaru
      $getTransaksi = Transaksi::where('customer_id', $this->getCustomer()->id)->latest()->get();
      // $getTransaksi = Transaksi::where('customer_id', $this->getCustomer()->id)->get();

      $data = [
         'title' => 'Transaksi',
         'transaksi' => $getTransaksi
      ];

      return view('customer/transaksi', $data);
   }

   public function detail_transaksi($transaksi_id)
   {
      // dd($transaksi_id);
      $getDetailtransaksi = DB::table('detail_transaksis')
         ->select('*', 'products.id AS id_produk')
         ->join('products', 'products.id', '=', 'detail_transaksis.produk_id')
         ->join('kategoris', 'kategoris.id', '=', 'products.kategori_id')
         ->where('transaksi_id', $transaksi_id)
         ->get();

      $getTransaksi = DB::table('transaksis')
         ->select('*', 'transaksis.id AS id_transaksi')
         ->join('customers', 'customers.id', '=', 'transaksis.customer_id')
         ->where('transaksis.id', $transaksi_id)
         ->first();
      // dd($getTransaksi);

      $tracking = DB::table('time_line_pesanans')
         ->select('*')
         ->where('transaksi_id', $transaksi_id)
         ->get();

      // dd($tracking);

      $data = [
         'title' => 'Detail Transaksi',
         'detail' => $getDetailtransaksi,
         'transaksi' => $getTransaksi,
         'tracking' => $tracking
      ];

      if (session()->get('role') == 2) {
         return view('customer/detail_transaksi', $data);
      } elseif (session()->get('role') == 1) {
         return view('owner/detail_transaksi', $data);
      }
   }

   public function proses_transaksi(Request $request, $transaksi_id)
   {
      $status = $request->status;

      Transaksi::where('id', $transaksi_id)->update([
         'status' => $status
      ]);

      TimeLinePesanan::create([
         'transaksi_id' => $transaksi_id,
         'customer_id' => $request->customer_id,
         'status' => $status,
         'tanggal' => date('Y-m-d')
      ]);

      return back()->with('success', 'Transaks berhasil di proses');
   }

   public function update(Request $request, $transaksi_id)
   {
      // update/upload bukti transfer
      // dd($transaksi_id);

      $request->validate([
         'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:3048',
      ]);

      $find = DB::table('transaksis')
         ->where('id', $transaksi_id)
         ->first();

      // dd($find);
      if ($request->gambar) {
         $imageName = $find->kode_transaksi . time() .  '.' .
            $request->gambar->extension();
         $request->gambar->move(public_path('img/bukti_transfer'), $imageName);

         if ($find->bukti_transfer == 'default.jpg') {
            Transaksi::where('id', $transaksi_id)->update([
               'bukti_transfer' => $imageName
            ]);
            return back()->with('success', 'Bukti transfer berhasil di upload');
         } else {

            Transaksi::where('id', $transaksi_id)->update([
               'bukti_transfer' => $imageName
            ]);

            unlink(public_path('img/bukti_transfer/' . $find->bukti_transfer));
            return back()->with('success', 'Bukti transfer berhasil di upload');
         }
      }
   }

   public function histori_transaksi()
   {
      // $cust = $this->getCustomer()->id;
      // // $cust = auth()->user()->id;
      // dd($cust);

      $history = DB::table('transaksis')
         ->select('*', 'transaksis.id AS id_transaksi')
         ->join('detail_transaksis', 'detail_transaksis.transaksi_id', '=', 'transaksis.id')
         ->join('products', 'products.id', '=', 'detail_transaksis.produk_id')
         ->where('customer_id', $this->getCustomer()->id)
         ->get();


      // ->join('detail_transaksis', 'detail_transaksis.transaksi_id', '=', 'transaksis.id')
      // ->join('products', 'products.id', '=', 'detail_transaksis.produk_id')
      // ->select(
      //    'transaksis.id AS id_transaksi',
      //    DB::raw('GROUP_CONCAT(detail_transaksis.jumlah SEPARATOR ",") AS qty'),
      //    DB::raw('GROUP_CONCAT(products.harga SEPARATOR ",") AS total_harga'),
      //    DB::raw('GROUP_CONCAT(products.id SEPARATOR ",") AS produk_id'),
      //    DB::raw('GROUP_CONCAT(products.nama_produk SEPARATOR ",") AS nama_produk'),
      // )
      // ->where('customer_id', $this->getCustomer()->id)
      // ->groupBy('id_transaksi')
      // ->get();

      // dd($history);

      $data = [
         'title' => 'Histori Transaksi',
         'history' => $history
      ];

      return view('customer/histori_transaksi', $data);
   }
}
