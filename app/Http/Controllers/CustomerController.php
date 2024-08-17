<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
   /**
    * Display a listing of the resource.
    */
   public function index()
   {
      //
      $getCustomer = DB::table('customers')
         ->join('users', 'users.id', '=', 'customers.user_id')
         ->where('role', 2)
         ->get();

      $data = [
         'title' => "Data Customer",
         'customer' => $getCustomer
      ];

      return view('owner/data_customer', $data);
   }

   /**
    * Show the form for creating a new resource.
    */
   public function create()
   {
      //
      $data = [
         'title' => "Form Tambah Customer"
      ];

      return view('owner/create_customer', $data);
   }

   /**
    * Store a newly created resource in storage.
    */
   public function store(Request $request)
   {
      //
      $request->validate([
         'nama_customer' => 'required',
         'alamat' => 'required',
         'no_hp' => 'required|numeric',
         'email' => 'required|email',
         'password' => 'required',
         'gambar.*' => 'nullable|image|mimes:jpeg,png,jpg|max:3048',
      ]);

      $insert_user =  User::create([
         'email' => $request->email,
         'password' => Hash::make($request->password),
         'role' => 2
      ]);

      if ($request->gambar) {
         $imageName = $request->nama_customer . time() .  '.' . $request->gambar->extension();
         $request->gambar->move(public_path('img/customer'), $imageName);
      } else {
         $imageName = 'default.jpg';
      }

      Customer::create([
         'user_id' => $insert_user->id,
         'nama_customer' => $request->nama_customer,
         'alamat' => $request->alamat,
         'no_hp' => $request->no_hp,
         'gambar' => $imageName
      ]);

      return redirect(route('customer.index'))->with("success", "Data customer berhasil di tambahkan");
   }

   /**
    * Display the specified resource.
    */
   public function show(string $id)
   {
      // dd($id);

      $find = DB::table('customers')
         ->join('users', 'users.id', '=', 'customers.user_id')
         ->where('customers.user_id', $id)
         ->first();

      $data = [
         'title' => "Detail Customer",
         'customer' => $find
      ];

      return view('owner/edit_customer', $data);
   }

   /**
    * Show the form for editing the specified resource.
    */
   public function edit(string $id)
   {
   }

   /**
    * Update the specified resource in storage.
    */
   public function update(Request $request, string $id)
   {
      //
      $request->validate([
         'nama_customer' => 'required',
         'alamat' => 'required',
         'no_hp' => 'required|numeric',
         'email' => 'required|email',
         'gambar.*' => 'nullable|image|mimes:jpeg,png,jpg|max:3048',
      ]);

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

      return redirect(route('customer.index'))->with("success", "Data customer berhasil di ubah");
   }

   /**
    * Remove the specified resource from storage.
    */
   public function destroy(string $id)
   {
      $findImage = Customer::where('user_id', $id)->first();
      $image = $findImage->gambar;
      // File::delete('img/customer/' . $image);

      Customer::where('user_id', $id)->delete();
      User::where('id', $id)->delete();
      // hapus gambar di direktori
      // public_path('img/customer/' . $image);

      // hapus gambar di direktori
      if ($image != 'default.jpg') {
         unlink(public_path('img/customer/' . $image));
      }

      return redirect(route('customer.index'))->with("success", "Data customer berhasil di hapus");
   }
}
