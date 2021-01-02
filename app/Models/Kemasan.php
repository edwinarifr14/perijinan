<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kemasan extends Model
{
    protected $table = 'kemasan', $primaryKey = 'kemasan_id';
    public $timestamps = false;

    public static function getAll() {
        return self::select([
            'kemasan_id',
            'kemasan_kode',
            'kemasan_deskripsi',
            'kemasan_gram'
        ]);
    }

    public function produks(){
        return $this->hasMany('App\Models\Produk', 'produk_kemasan');
    }
}
