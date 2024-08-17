<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Transaksi;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Models\DetailTransaksi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Home extends Controller
{
   //
   public function getCustomer()
   {
      $getCustomer = Customer::where('user_id', session()->get('id'))->first();
      return $getCustomer;
   }
   public function index()
   {
      $getProduct = DB::table('products')
         ->select('*', 'products.id AS id_produk')
         ->join('kategoris', 'kategoris.id', '=', 'products.kategori_id')->get()
         ->where('status', 'aktif');

      $data = [
         'title' => 'Home',
         'product' => $getProduct
      ];

      return view('home', $data);
   }

   public function detail_product($id_produk)
   {
      $getProduct = DB::table('products')
         ->select('*', 'products.id AS id_produk')
         ->where('products.id', $id_produk)
         ->join('kategoris', 'kategoris.id', '=', 'products.kategori_id')->first();

      $getProductImage = ProductImage::where('produk_id', $id_produk)->get();
      //dd($getProductImage[0]->gambar);
      $data = [
         'title' => 'Detail Produk',
         'product' => $getProduct,
         'product_image' => $getProductImage
      ];

      return view('detail_product', $data);
   }

   public function cart()
   {
      $getKeranjang = DB::table('carts')
         ->select("*", 'products.id AS id_produk', 'carts.id AS id_keranjang')
         ->join('products', 'products.id', '=', 'carts.produk_id')->get();

      $data = [
         'title' => 'Keranjang',
         'cart' => $getKeranjang
      ];

      return view('customer/data_keranjang', $data);
   }

   public function add_cart(Request $request, $id_produk)
   {
      if (session()->get('logged_in') != true) {
         return redirect('/login')->with('error', 'Silahkan login terlebih dahulu');
      }

      $jumlah = $request->jumlah;
      $total_harga = $request->total_harga;

      $getKeranjang = Cart::where('produk_id', $id_produk)->first();

      if ($getKeranjang) {
         $data = [
            'customer_id' => $this->getCustomer()->id,
            'produk_id' => $id_produk,
            'jumlah' => $jumlah + $getKeranjang->jumlah,
            'total_harga' => $total_harga + $getKeranjang->total_harga
         ];
         cart::where('customer_id', $this->getCustomer()->id)
            ->where('produk_id', $id_produk)
            ->update($data);

         return redirect('/customer/data_keranjang')->with('success', 'Produk berhasil di update ke data keranjang');
      } else {
         $data = [
            'customer_id' => $this->getCustomer()->id,
            'produk_id' => $id_produk,
            'jumlah' => $jumlah,
            'total_harga' => $total_harga
         ];
         Cart::create($data);

         return redirect('/customer/data_keranjang')->with('success', 'Produk berhasil di tambahkan ke data keranjang');
      }
   }

   public function drop_cart(string $id)
   {
      // dd($id);
      Cart::where('customer_id', $this->getCustomer()->id)->delete();
      return redirect('/customer/data_keranjang')->with('success', 'Data keranjang berhasil di hapus');
   }

   public function edit_profile(string $id)
   {
      $find = Customer::join('users', 'users.id', '=', 'customers.user_id')->where('user_id', $id)->first();
      return view('customer/edit_profile', ['customer' => $find]);
   }

   public function update_profile(Request $request, string $id)
   {
      $find = DB::table('customers')
         ->join('users', 'users.id', '=', 'customers.user_id')
         ->where('customers.user_id', $id)
         ->first();

      // dd($find);

      if ($request->gambar) {
         $imageName = $request->nama_customer . time() .  '.' . $request->gambar->extension();
         $request->gambar->move(public_path('img/customer'), $imageName);

         // hapus gambar di direktori
         unlink(public_path('img/customer/' . $find->gambar));
      } else {
         $imageName = $find->gambar;
      }

      if ($request->password != null) {
         $password = Hash::make($request->password);
         Customer::where('user_id', $id)->update([
            'nama_customer' => $request->nama_customer,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'gambar' => $imageName
         ]);

         User::where('id', $find->user_id)->update([
            'name' => $request->nama_customer,
            'email' => $request->email,
            'password' => $password
         ]);
      } else {
         Customer::where('user_id', $id)->update([
            'nama_customer' => $request->nama_customer,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'gambar' => $imageName
         ]);

         User::where('id', $find->user_id)->update([
            'name' => $request->nama_customer,
            'email' => $request->email
         ]);
      }

      return redirect('/home')->with("success", "Data customer berhasil di ubah");
   }
}
