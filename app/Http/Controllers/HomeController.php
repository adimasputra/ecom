<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Pelanggan;
use Auth;
class HomeController extends Controller
{
    public function login(){
        return view('login');
    }
    public function loginadmin(){
        return view('admin.login');
    }
    public function loginsubmit(Request $request){
        if(Auth::guard('pelanggan')->attempt(['username' => $request->username, 'password' => $request->password])){
            return redirect()->route('home');
        }
        else{
            return redirect()->back()->with('error','Username atau Password anda salah, silahkan coba lagi');
        }
    }
    public function loginadminsubmit(Request $request){
        if(Auth::guard('user')->attempt(['username' => $request->username, 'password' => $request->password])){
            return redirect()->route('dashboard');
        }
        else{
            return redirect()->back()->with('error','Username atau Password anda salah, silahkan coba lagi');
        }
    }

    public function register(){
        return view('register');
    }
    public function registersubmit(Request $request){
       
        $user = new Pelanggan;
        $user->nama = $request->nama;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->no_telp = $request->no_telpon;
        $user->alamat = $request->alamat;
        $user->save();
        return redirect()->route('login')->with('success','Akunmu berhasil dibuat , Silahkan login');
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('home');
    }
}
