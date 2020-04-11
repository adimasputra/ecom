<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPembelian extends Model
{
    public $table = 'detail_pembelian';
    protected $fillable = [
        'id','qty', 'ikan_id', 'pembelian_id'
    ]; 
    public function ikan() {
        return $this->belongsTo('App\Ikan','ikan_id','id');
    }
}
