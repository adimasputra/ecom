<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreIkan;
use DB;
use Yajra\Datatables\Datatables;
use Auth;
use App\Ikan;
use App\Tambak;
use App\User;
class IkanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.ikan.index');
    }

    public function datatable(){
        if(Auth::user()->level == 1){
            $data = DB::table('ikan')->join('tambak','ikan.tambak_id','tambak.id')
                                     ->select('ikan.*','tambak.nama_tambak')
                                     ->orderBy('ikan.created_at','DESC')
                                     ->get(); 
        }
        else{
            $data = DB::table('ikan')->join('tambak','ikan.tambak_id','tambak.id')
                                     ->select('ikan.*','tambak.nama_tambak')
                                     ->where('tambak.user_id', Auth::user()->id)
                                     ->orderBy('ikan.created_at','DESC')
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
        $input = Ikan::defaultValues();
        if(Auth::user()->level == 1){
            $tambak = Tambak::all();
        }
        else{
            $tambak = Tambak::where('user_id' , Auth::user()->id)->get();
        }
        
        return view('admin/ikan/form', compact('input', 'tambak'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIkan $request)
    {
      
        $check = Ikan::where('kode',$request->kode)->where('tambak_id',$request->tambak_id)->get();

        if(count($check) > 0){
            return redirect()->back()->with('error','Kode sudah pernah digunakan, pakai kode lain');
        }
        $input = $request->all();
        $input['foto'] = '';

        if($request->hasFile('foto')){
            $request->foto->store('foto');
            $input['foto'] = $request->foto->hashName();
        }

        Ikan::create($input);
        return redirect()->route('ikan.index')->with('success', 'Berhasil menambah data ikan');
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
        $input = Ikan::find($id);
        if(Auth::user()->level == 1){
            $tambak = Tambak::all();
        }
        else{
            $tambak = Tambak::where('user_id' , Auth::user()->id)->get();
        }
        
        return view('admin/ikan/form', compact('input', 'tambak'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ikan = Ikan::find($id);
        $check = Ikan::where('kode',$request->kode)->where('kode','!=',$ikan->kode)->where('tambak_id',$request->tambak_id)->get();
        

        if(count($check) > 0){
            return redirect()->back()->with('error','Kode sudah pernah digunakan, pakai kode lain');
        }
        if($request->hasFile('foto')){
            //remove old photos
            if(is_file('storage/foto/'.$ikan->foto)){
                unlink('storage/foto/'.$ikan->foto);
            }
            $request->foto->store('foto');
            $rename = $request->foto->hashName();
        } else {
            $rename = $ikan->foto;
        }

        $input = $request->all();

        $input['foto'] = $rename;

        $ikan->update($input);

        return redirect()->route('ikan.index')->with('success', 'Berhasil mengubah data ikan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ikan = Ikan::find($id);
        if($ikan->cover != ''){
            //remove old photos
            if(is_file('storage/foto/'.$ikan->cover)){
                unlink('storage/foto/'.$ikan->cover);
            }
        }
        $ikan->delete();
        return 1;
    }
}
