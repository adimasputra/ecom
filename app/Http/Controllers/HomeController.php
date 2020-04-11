<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Pelanggan;
use App\Ikan;
use App\Kabupaten;
use App\Pembelian;
use App\DetailPembelian;
use App\Pengiriman;
use App\Pembayaran;
use Auth;
use Carbon\Carbon;
use Session;
class HomeController extends Controller
{
    public function index(){
        $ikan = Ikan::with('tambak')->paginate(8);
        
        return view('index',compact('ikan'));
    }
    public function detail($id){
        $ikan = Ikan::find($id);
        $other = Ikan::where('tambak_id', $ikan->tambak_id)->where('id','!=',$id)->paginate(4);
        return view('detail-ikan',compact('ikan','other'));
    }
    public function cart(){
        return view('cart');
    }
    public function insertcart($id){
        
        $ikan = Ikan::find($id);
        
        $cart = Session::get('cart');
        if(!$cart){
            
            $cart = [
                $id => [
                    "id" => $ikan->id,
                    "nama_ikan" => $ikan->nama_ikan,
                    "harga" => $ikan->harga,
                    "foto" => $ikan->foto,
                    "berat" => $ikan->berat,
                    "tambak" => $ikan->tambak->nama_tambak,
                    "qty" => 1,
                ]
            ];
                
            
            Session::put('cart',$cart);
            return redirect()->route('cart');
        }
        if(isset($cart[$id])) {
 
            $cart[$id]['qty']++;
 
            session()->put('cart', $cart);
 
            return redirect()->route('cart');
 
        }
        
        $cart[$id] = [
            "id" => $ikan->id,
            "nama_ikan" => $ikan->nama_ikan,
            "harga" => $ikan->harga,
            "foto" => $ikan->foto,
            "berat" => $ikan->berat,
            "tambak" => $ikan->tambak->nama_tambak,
            "qty" => 1,
        ];
 
        session()->put('cart', $cart);
       
        
        return redirect()->route('cart');
    }
    public function deletecart($id){
        if($id) {
 
            $cart = session()->get('cart');
            if(isset($cart[$id])) {
 
                unset($cart[$id]);
 
                session()->put('cart', $cart);
            }
        }
        
        return 1;
    }
    public function updatecart(Request $request,$id){
        
        $cart = session()->get('cart');
        $cart[$request->id]["qty"] = $request->qty;

        session()->put('cart', $cart);
        return 1;
    }
    public function login(){
        return view('login');
    }
    public function profil(){
        return view('profil');
    }
    public function profilstore(Request $request){
        $pelanggan = Pelanggan::find(Auth::guard('pelanggan')->user()->id);
        $pelanggan->nama = $request->nama_pelanggan;
        $pelanggan->email = $request->email;
        $pelanggan->no_telp = $request->no_telp;
        $pelanggan->alamat = $request->alamat;
        $pelanggan->update();
        return redirect()->back()->with('success','Data profil berhasil diubah');
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
    public function logout(Request $request){
        
        $request->session()->flush();
        return redirect()->route('home');
    }

    public function checkout(){
        if(!Session::get('cart')){
            return redirect()->back();
        }
        $user = Auth::guard('pelanggan')->user();
        $kab = Kabupaten::all();
        return view('checkout',compact('user','kab'));
    }
    public function listpembelian(){
        $pembelian = Pembelian::where('pelanggan_id',Auth::guard('pelanggan')->user()->id)->orderBy('created_at','desc')->with('pembayaran')->get();
        
        return view('list-pembelian',compact('pembelian'));
    }
    public function pembelian(Request $request){
        
        $pin = mt_rand(10000, 99999);
        $string = str_shuffle($pin);
        $invoice = "INV - ".$string;
        $pembelian = new Pembelian;
        $pembelian->invoice = $invoice;
        $pembelian->tanggal_pembelian = Carbon::now();
        $pembelian->total_nominal = $request->total + $request->ongkir;
        $pembelian->status_pembelian = 1;
        $pembelian->pelanggan_id = Auth::guard('pelanggan')->user()->id;
        $pembelian->save();

        foreach(Session::get('cart') as $value){
            $detail = new DetailPembelian;
            $detail->qty = $value['qty'];
            $detail->ikan_id = $value['id'];
            $detail->pembelian_id = $pembelian->id;
            $detail->save();
        }
        $pengiriman = new Pengiriman;
        $pengiriman->alamat_pengiriman = $request->alamat;
        $pengiriman->kabupaten = $request->kabupaten;
        $pengiriman->ongkir = $request->ongkir;
        $pengiriman->pembelian_id = $pembelian->id;
        $pengiriman->save();
        Session::forget('cart');
        return $pembelian->id;
    }
}
