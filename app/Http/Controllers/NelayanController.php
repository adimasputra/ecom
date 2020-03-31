<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Yajra\Datatables\Datatables;
use Auth;
use App\Tambak;
use App\User;
use Crypt;
class NelayanController extends Controller
{
    public function index(){
        return view('admin.nelayan.index');
    }
    public function datatable(){
        $data = DB::table('users')->join('tambak','users.id','tambak.user_id')->select('users.*','users.id as iduser','tambak.*')->orderBy('users.created_at','DESC')->get();
      
        return Datatables::of($data)->make(true);
    }
    public function create()
    {
        $inputuser = User::defaultValues();
        $inputtambak = Tambak::defaultValues();
       
        return view('admin/nelayan/form', compact('inputuser', 'inputtambak'));
    }
    public function store(Request $request){
   
        //create
        if($request->iduser == null && $request->idtambak == null){
            $file = $request->file('foto');
 
            $nama_file = time()."_".$file->getClientOriginalName();
            
                      
            
            $user = new User;
            $user->nama = $request->nama;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->level = 0;
            $user->save();
            $tambak = new Tambak;
            $tambak->nama_tambak = $request->nama_tambak;
            $tambak->no_telp = $request->no_telp;
            $tambak->alamat = $request->alamat;
            $tambak->foto = $nama_file;
            $tambak->user_id = $user->id;
            
            $tambak->save();
            $tujuan_upload = 'img';
            $file->move($tujuan_upload,$nama_file);
            return redirect()->route('nelayan.index')->with('success', 'Berhasil menambah nelayan');
        }
        
     
    }

    public function edit($id){
       
        $inputuser = User::find($id);
       
        return view('admin/nelayan/form', compact('inputuser'));
    }
    public function update(Request $request,$id){
       
        if(!Auth::validate(['username' => $request->username, 'password' => $request->password])){
            return redirect()->back()->with('error','Password tidak sesuai');
        }
        $user = User::find($id);
        $user->nama = $request->nama;
        $user->username = $request->username;
        $user->email = $request->email;
        if($request->passwordbaru){
            $user->password = bcrypt($request->passwordbaru);
        }
        $user->update();
        return redirect()->route('nelayan.index')->with('success', 'Berhasil mengubah data nelayan');
    }
    public function destroy($id)
    {
        
        $user = User::find($id);
        $tambak = Tambak::where('user_id',$user->id)->delete();
       
        $user->delete();
        return 1;
    }

}
