<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Keranjang extends Model {
    protected $table = 'keranjang', $primaryKey = 'keranjang_id';
    public $timestamps = false;

    public static function productInCarts($pelangganId){
        return DB::table((new self)->table)
            ->where('keranjang_pelanggan', $pelangganId)
            ->join('produk', 'keranjang_produk', 'produk_id')
            ->join('kemasan', 'kemasan_id', 'produk_kemasan')
            ->select('*')
            ->get();
    }
}
