<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk', $primaryKey = 'produk_id';
    public $timestamps = false;

    public static function getAll() {
        return self::with(['kategori', 'kemasan'])->select([
            'produk_id',
            'produk_kategori',
            'produk_kemasan',
            'produk_nama',
            'produk_harga',
            'produk_deskripsi',
            'produk_stok',
            'produk_gambar',
            'pemilik'
        ]);
    }

    public function kategori(){
        return $this->belongsTo('App\Models\Kategori', 'produk_kategori');
    }

    public function kemasan(){
        return $this->belongsTo('App\Models\Kemasan', 'produk_kemasan');
    }
}
