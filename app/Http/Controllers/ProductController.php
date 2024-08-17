<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Echo_;

class ProductController extends Controller
{
   /**
    * Display a listing of the resource.
    */
   public function index()
   {
      //
      $getProduct = DB::table('products')
         ->select('*', 'products.id AS id_produk')
         ->join('kategoris', 'kategoris.id', '=', 'products.kategori_id')->get();

      $data = [
         'title' => 'Data Produk',
         'product' => $getProduct
      ];

      return view('owner/data_product', $data);
   }

   /**
    * Show the form for creating a new resource.
    */
   public function create()
   {
      //
      $getKategori = Kategori::all();
      $data = [
         'title' => 'Form Tambah Produk',
         'kategori' => $getKategori
      ];

      return view('owner/create_product', $data);
   }

   /**
    * Store a newly created resource in storage.
    */
   public function store(Request $request)
   {
      //
      // dd($request->gambar);

      $request->validate([
         'nama_produk' => 'required',
         'kategori_id' => 'required',
         'stok' => 'required|numeric',
         'harga' => 'required',
         'gambar.*' => 'required|image|mimes:jpeg,png,jpg|max:3048',
      ]);

      $insertProduk = Product::create([
         'nama_produk' => $request->nama_produk,
         'kategori_id' => $request->kategori_id,
         'deskripsi' => $request->deskripsi,
         'stok' => $request->stok,
         'harga' => str_replace(".", "", $request->harga),
         'status' => 'aktif'
      ]);

      $images = $request->file('gambar');

      if ($images == null) {
         ProductImage::create([
            'produk_id' => $insertProduk->id,
            'gambar' => 'default.jpg',
         ]);
      } else {

         foreach ($images as $image) {
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('img/product'), $filename);

            // Simpan nama file ke database
            ProductImage::create([
               'produk_id' => $insertProduk->id,
               'gambar' => $filename,
            ]);
         }
      }

      return redirect(route('data_product.index'))->with("success", "Data produk berhasil di tambahkan");
   }

   /**
    * Display the specified resource.
    */
   public function show(string $id)
   {
      //
   }

   /**
    * Show the form for editing the specified resource.
    */
   public function edit(string $id)
   {
      $find = DB::table('products')
         // ->join('kategoris', 'kategoris.id', '=', 'products.kategori_id')
         ->where('products.id', $id)
         ->first();

      $getKategori = Kategori::all();
      $getImages = ProductImage::where('produk_id', $id)->get();
      $imagesCount = $getImages->count();
      $data = [
         'title' => 'Form Edit Produk',
         'product' => $find,
         'kategori' => $getKategori,
         'images' => $getImages,
         'imagesCount' => $imagesCount
      ];
      // dd($getImages->count());

      return view('owner/edit_product', $data);
   }



   /**
    * Update the specified resource in storage.
    */
   public function update(Request $request, string $id)
   {
      $request->validate([
         'nama_produk' => 'required',
         'kategori_id' => 'required',
         'stok' => 'required|numeric',
         'harga' => 'required',
         'gambar.*' => 'required|image|mimes:jpeg,png,jpg|max:3048',
      ]);


      $updateProduk = Product::where('id', $id)->update([
         'nama_produk' => $request->nama_produk,
         'kategori_id' => $request->kategori_id,
         'deskripsi' => $request->deskripsi,
         'stok' => $request->stok,
         'harga' => str_replace(".", "", $request->harga),
         'status' => $request->status
      ]);

      $images = $request->file('gambar');

      if ($images != null) {

         foreach ($images as $image) {
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('img/product'), $filename);

            // Simpan nama file ke database
            ProductImage::create([
               'produk_id' => $id,
               'gambar' => $filename,
            ]);
         }
      }

      return redirect(route('data_product.index'))->with("success", "Data produk berhasil di update");
   }

   /**
    * Remove the specified resource from storage.
    */
   public function destroy(string $id)
   {
   }
}
