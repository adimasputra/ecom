<?php

namespace App;

use Illuminate\Foundation\Auth\Pelanggan as Authenticatable;

class Pelanggan extends Authenticatable
{
    public $table = 'pelanggan';
    protected $fillable = [
        'nama', 'email', 'password','username','no_telp','alamat'
    ];
}
