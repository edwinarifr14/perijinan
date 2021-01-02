<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model{
    protected
        $table = 'pelanggan',
        $primaryKey = 'pelanggan_id',
        $hidden = ['pelanggan_password'];

    public $timestamps = false;


    public static function check($email) {
        return self::where('pelanggan_email', $email)
            ->first()
                ?: false;
    }

}
