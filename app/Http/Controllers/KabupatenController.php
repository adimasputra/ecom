<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kabupaten;
use Yajra\Datatables\Datatables;
use Auth;
use DB;
use App\User;
class KabupatenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.kabupaten.index');
    }

    public function datatable(){
        
        $data = DB::table('kabupaten')->orderBy('created_at','DESC')->get();
            
        
      
        return Datatables::of($data)->make(true);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $input = Kabupaten::defaultValues();
        return view('admin/kabupaten/form', compact('input'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        Kabupaten::create($input);
        return redirect()->route('kabupaten.index')->with('success', 'Berhasil menambah data');
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
        $input = Kabupaten::find($id);
        
        return view('admin/kabupaten/form', compact('input'));
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
        $kabupaten = Kabupaten::find($id);

        $input = $request->all();
        $kabupaten->update($input);

        return redirect()->route('kabupaten.index')->with('success', 'Berhasil mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kabupaten = Kabupaten::find($id);
        
    
        $kabupaten->delete();
        return 1;
    }
}
