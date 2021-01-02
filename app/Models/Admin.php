<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admin', $primaryKey = 'admin_id';
    public $timestamps = false;

    public static function check($username) {
        return self::where('admin_username', $username)
            ->first()
                ?: false;
    }

    public static function getAll() {
        return self::select([
            'admin_id',
            'admin_username',
            'admin_nama',
            'admin_kontak',
            'admin_level'
        ]);
    }
}
