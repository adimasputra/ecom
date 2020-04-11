<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    public $table = 'pembayaran';
    protected $fillable = [
        'invoice', 'tanggal_pembayaran', 'bukti_pembayaran','status_pembayaran','pembelian_id'
    ];
    public static function defaultValues(){
        return [
            'tanggal_pembayaran' => '',
            'bukti_pembayaran' => '',
            
        ];
    }
}
