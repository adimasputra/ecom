<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ikan extends Model
{
    protected $table = 'ikan';

    protected $fillable = [
        'id',
        'kode',
        'nama_ikan',
        'harga',
        'foto',
        'berat',
        'deskripsi',
        'tambak_id'
    ];

    public function tambak()
    {
        return $this->belongsTo('App\Tambak');
    }

    public static function defaultValues(){
        return [
            'kode' => '',
            'nama_ikan' => '',
            'harga' => '',
            'foto' => '',
            'berat' => '',
            'tambak_id' => '',
            'deskripsi' => '',
        ];
    }
}
