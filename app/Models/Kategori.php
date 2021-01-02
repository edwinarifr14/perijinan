<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori', $primaryKey = 'kategori_id';
    public $timestamps = false;

    public static function getAll() {
        return self::select([
            'kategori_id',
            'kategori_nama',
            'kategori_deskripsi'
        ]);
    }

    public function produks(){
        return $this->hasMany('App\Models\Produk', 'produk_kategori');
    }
}
