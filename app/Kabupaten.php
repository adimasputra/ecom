<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    protected $table = 'kabupaten';

    protected $fillable = [
        'id',
        'ongkir',
        'nama',
        
    ];

    public static function defaultValues(){
        return [
            'nama' => '', 
            'ongkir' => '', 
        
        ];
    }
}
