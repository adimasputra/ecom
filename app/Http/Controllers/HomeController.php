<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
class HomeController extends Controller
{
    public function login(){
        return view('login');
    }
    public function loginsubmit(Request $request){
        if(Auth::attempt(['username' => $request->username, 'password' => $request->password])){
            return redirect()->route('home');
        }
        else{
            return redirect()->back()->with('error','Username atau Password anda salah, silahkan coba lagi');
        }
    }

    public function register(){
        return view('register');
    }
    public function registersubmit(Request $request){
       
        $user = new User;
        $user->nama = $request->nama;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->level = 'pemilik';
        $user->save();
        return redirect()->route('login')->with('success','Akunmu berhasil dibuat , Silahkan login');
    }
}
