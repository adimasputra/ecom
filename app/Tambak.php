<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tambak extends Model
{
    public $table = 'tambak';
    protected $fillable = [
        'nama_tambak', 'alamat', 'no_telp','foto','user_id', 'status'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public static function defaultValues(){
        return [
            'nama_tambak' => '', 
            'alamat' => '', 
            'no_telp' => '',
            'foto' => '',
            'user_id' => '', 
            'status' => ''
        ];
    }
}
