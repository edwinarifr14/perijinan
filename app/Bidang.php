<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    protected $table = 'bidang', $primaryKey = 'bidang_id';
    public $timestamps = false;

    public static function getAll() {
        return self::select([
            'bidang_id',
            'nama'
        ]);
    }
}
