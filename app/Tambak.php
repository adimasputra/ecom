<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tambak extends Model
{
    public $table = 'tambak';
    protected $fillable = [
        'nama_tambak', 'alamat', 'no_telp','foto','user_id'
    ];
}
