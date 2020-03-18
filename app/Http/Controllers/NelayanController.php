<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Yajra\Datatables\Datatables;
use Auth;
use App\Tambak;
use App\User;

class NelayanController extends Controller
{
    public function index(){
        return view('admin.nelayan.index');
    }
    public function datatable(){
        $data = DB::table('users')->join('tambak','users.id','tambak.user_id')->select('users.*','users.id as iduser','tambak.*')->orderBy('users.created_at','DESC')->get();
      
        return Datatables::of($data)->make(true);
    }
    public function store(Request $request){
        //create
        if($request->iduser == null && $request->idtambak == null){
            $file = $request->file('file');
 
            $nama_file = time()."_".$file->getClientOriginalName();
            
                      
            
            $user = new User;
            $user->nama = $request->nama;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->level = 'pemilik';
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
            return 1;
        }
        //update
        else{
            //script update
        }
     
    }

    public function edit($id){
       
        $data = DB::table('users')->join('tambak','users.id','tambak.user_id')->where('users.id',$id)->select('users.*','users.id as iduser','tambak.*')->get();
       
        return $data;
    }

}
