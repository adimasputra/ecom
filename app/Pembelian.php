<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    public $table = 'pembelian';
    protected $fillable = [
        'invoice', 'tanggal_pembelian', 'total_nominal','status_pembelian','pelanggan_id'
    ];
    public function pembayaran() {
        return $this->hasOne('App\Pembayaran','pembelian_id','id');
    }
}
