<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTambak;
use Illuminate\Http\Request;
use App\Tambak;
use Yajra\Datatables\Datatables;
use Auth;
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

        return view('admin.tambak.index', compact('tambak'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $input = Tambak::defaultValues();
        $user = User::where('level' , 0)->get();
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
        $user = User::all();
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
        if($tambak->cover != ''){
            //remove old photos
            if(is_file('storage/foto/'.$tambak->cover)){
                unlink('storage/foto/'.$tambak->cover);
            }
        }
        $tambak->delete();
        return redirect()->route('tambak.index')->with('success', 'Berhasil menambah menghapus tambak');
    }
}
