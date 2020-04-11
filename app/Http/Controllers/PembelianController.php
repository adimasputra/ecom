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

class PembelianController extends Controller
{
    public function bayarpembelian($id)
    {
        $pembelian = Pembelian::where('id',$id)->where('pelanggan_id',Auth::guard('pelanggan')->user()->id)->first();
        if(count($pembelian) > 0){
            $pembayaran = Pembayaran::where('pembelian_id',$id)->first();
            $detail = DetailPembelian::where('pembelian_id',$id)->with('ikan')->get();
            $pengiriman = Pengiriman::where('pembelian_id',$id)->first();
            if(is_null($pembayaran)){
                $pembayaran = Pembayaran::defaultValues();
            }
            
            return view('pembayaran',compact('pembelian','pengiriman','detail','pembayaran'));
        }
        
    }
    public function store(Request $request)
    {
        $pembelian = Pembelian::find($request->pembelian_id);

        $check = Pembayaran::where('pembelian_id',$request->pembelian_id)->get();
        if(count($check) == 0){
            $pembayaran = new Pembayaran;
            $pembayaran->invoice = $pembelian->invoice;
            $pembayaran->tanggal_pembayaran = $request->tanggal_pembayaran;
            $request->bukti->store('foto');
            $rename = $request->bukti->hashName();
            $pembayaran->bukti_pembayaran = $rename;
            $pembayaran->status_pembayaran = 1;
            $pembayaran->pembelian_id = $request->pembelian_id;
            $pembayaran->save();
        }
        else{
            $pembayaran = Pembayaran::where('pembelian_id',$request->pembelian_id)->first();
            if($request->hasFile('bukti')){
                
                if(is_file('storage/foto/'.$pembayaran->bukti_pembayaran)){
                    unlink('storage/foto/'.$pembayaran->bukti_pembayaran);
                }
                $request->bukti->store('foto');
                $rename = $request->bukti->hashName();
                Pembayaran::where('pembelian_id',$request->pembelian_id)->update([
                    'tanggal_pembayaran' => $request->tanggal_pembayaran,
                    'bukti_pembayaran' => $rename
                ]);
            }
            else{
                Pembayaran::where('pembelian_id',$request->pembelian_id)->update([
                    'tanggal_pembayaran' => $request->tanggal_pembayaran,
                    
                ]);
            }
            
        }
        
        return redirect()->back()->with('success', 'Berhasil menyimpan data');
        
    }
    public function batal($id){
        
        $pembelian = Pembelian::find($id);
        $pembelian->status_pembelian = 4;
        $pembelian->update();
        return 1;
    }
}
