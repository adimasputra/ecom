<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    public $table = 'pengiriman';
    protected $fillable = [
        'alamat_pengiriman', 'kabupaten', 'ongkir','tanggal_kirim','pembelian_id'
    ];
}
