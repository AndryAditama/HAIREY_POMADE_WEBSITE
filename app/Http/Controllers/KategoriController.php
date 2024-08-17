<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
   /**
    * Display a listing of the resource.
    */
   public function index()
   {
      //
      $getKategori = Kategori::all();
      $data = [
         'title' => 'Kategori Produk',
         'kategori' => $getKategori
      ];

      return view('owner/kategori_product', $data);
   }

   /**
    * Show the form for creating a new resource.
    */
   public function create()
   {
      //
   }

   /**
    * Store a newly created resource in storage.
    */
   public function store(Request $request)
   {
      //
      $request->validate([
         'nama_kategori' => 'required'
      ]);

      $cekKategori = Kategori::where('nama_kategori', $request->nama_kategori)->first();

      if ($cekKategori) {
         return back()->with('error', 'Kategori produk sudah ada');
      }

      Kategori::create([
         'nama_kategori' => $request->nama_kategori
      ]);

      return back()->with('success', 'Kategori produk berhasil ditambahkan');
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
      //
   }

   /**
    * Update the specified resource in storage.
    */
   public function update(Request $request, string $id)
   {
      $find = Kategori::find($id);
      $find->update([
         'nama_kategori' => $request->edit_nama_kategori
      ]);
      return back()->with('success', 'Kategori produk berhasil di ubah');
   }

   /**
    * Remove the specified resource from storage.
    */
   public function destroy(string $id)
   {
      //   hapus data kategori
      $cekKategori = Kategori::find($id);
      $cekKategori->delete();
      return back()->with('success', 'Kategori produk berhasil di hapus');
   }
}
