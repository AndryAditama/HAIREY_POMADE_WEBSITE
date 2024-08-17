<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Owner;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
   //
   public function index()
   {
      return view("login");
   }

   public function register()
   {

      return view('register');
   }

   public function createRegister(Request $request)
   {
      // dd('register');
      // $request->validate([
      //    'nama_customer' => 'required',
      //    'alamat' => 'required',
      //    'no_hp' => 'required|numeric',
      //    'email' => 'required|email',
      //    'password' => 'required',
      //    // 'gambar.*' => 'nullable|image|mimes:jpeg,png,jpg|max:3048',
      // ]);

      // dd($request);

      $insert_user =  User::create([
         'name' => $request->nama_customer,
         'email' => $request->email,
         'password' => Hash::make($request->password),
         'role' => 2
      ]);

      // if ($request->gambar) {
      //    $imageName = $request->nama_customer . time() .  '.' . $request->gambar->extension();
      //    $request->gambar->move(public_path('img/customer'), $imageName);
      // } else {
      //    $imageName = 'default.jpg';
      // }

      Customer::create([
         'user_id' => $insert_user->id,
         'nama_customer' => $request->nama_customer,
         'alamat' => $request->alamat,
         'no_hp' => $request->no_hp,
         'gambar' => 'default.jpg'
      ]);

      Session::flash('success', 'Registrasi berhasil!');

      return redirect('/register')->with("success", "Data customer berhasil di tambahkan");
   }

   public function CekLogin(Request $request)
   {
      $email = $request->email;

      $credentials = $request->validate([
         "email" => "required|email",
         "password" => "required"
      ]);

      if (Auth::attempt($credentials)) {
         $cek_auth = User::where(["email" => $email])->first();
         if ($cek_auth->role == 1) {
            $getOwner = Owner::where('user_id', $cek_auth->id)->first();
            // $getOwner = User::where('id', $cek_auth->id)->first();
            session(["role" => 1]);
            session(["id" => $cek_auth->id]);
            session(["name" => $getOwner->nama_owner]);
            session(["image" => $getOwner->image]);
            session(['logged_in' => true]);
            return redirect('/dashboard')->with("success", "login berhasil");
         } elseif ($cek_auth->role == 2) {
            $getCustomer = Customer::where('user_id', $cek_auth->id)->first();
            session(["role" => 2]);
            session(["id" => $cek_auth->id]);
            session(["name" => $getCustomer->nama_customer]);
            session(["image" => $getCustomer->gambar]);
            session(['logged_in' => true]);
            return redirect("/home")->with("success", "login berhasil");
         }
      }
      return redirect('/login')->with("error", "username dan password tidak sesuai");
   }

   public function logout()
   {
      session()->flush();
      return redirect('/login');
   }
}
