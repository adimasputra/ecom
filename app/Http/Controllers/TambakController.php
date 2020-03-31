<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTambak;
use Illuminate\Http\Request;
use App\Tambak;
use Yajra\Datatables\Datatables;
use Auth;
use DB;
use App\User;

class TambakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->level == 1){
            $tambak = Tambak::all(); 
        }
        else{
            $tambak = Tambak::where('user_id',Auth::user()->id)->get();
            
        }
        
        return view('admin.tambak.index', compact('tambak'));
    }

    public function datatable(){
        if(Auth::user()->level == 1){
            $data = DB::table('tambak')->join('users','tambak.user_id','users.id')
                                     ->select('tambak.*','users.nama as nama_pemilik')
                                     ->orderBy('tambak.created_at','DESC')
                                     ->get(); 
        }
        else{
            $data = DB::table('tambak')->join('users','tambak.user_id','users.id')
                                     ->select('tambak.*','users.nama as nama_pemilik')
                                     ->where('tambak.user_id', Auth::user()->id)
                                     ->orderBy('tambak.created_at','DESC')
                                     ->get();
            
        }
      
        return Datatables::of($data)->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $input = Tambak::defaultValues();
        if(Auth::user()->level == 1){
            $user = User::where('level' , 0)->get(); 
        }
        else{
            $user = Auth::user();
        }
        
        return view('admin/tambak/form', compact('input', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTambak $request)
    {
       
        $input = $request->all();
        $input['foto'] = '';

        if($request->hasFile('foto')){
            $request->foto->store('foto');
            $input['foto'] = $request->foto->hashName();
        }

        Tambak::create($input);

        return redirect()->route('tambak.index')->with('success', 'Berhasil menambah tambak');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $input = Tambak::find($id);
        if(Auth::user()->level == 1){
            $user = User::where('level' , 0)->get(); 
        }
        else{
            $user = Auth::user();
        }
        return view('admin/tambak/form', compact('input', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTambak $request, $id)
    {
        $tambak = Tambak::find($id);

        if($request->hasFile('foto')){
            //remove old photos
            if(is_file('storage/foto/'.$tambak->foto)){
                unlink('storage/foto/'.$tambak->foto);
            }
            $request->foto->store('foto');
            $rename = $request->foto->hashName();
        } else {
            $rename = $tambak->foto;
        }

        $input = $request->all();

        $input['foto'] = $rename;

        $tambak->update($input);

        return redirect()->route('tambak.index')->with('success', 'Berhasil mengubah data tambak');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $tambak = Tambak::find($id);
        
        if($tambak->foto != ''){
            //remove old photos
            if(is_file('storage/foto/'.$tambak->foto)){
                unlink('storage/foto/'.$tambak->foto);
            }
        }
        $tambak->delete();
        return 1;
    }
}
