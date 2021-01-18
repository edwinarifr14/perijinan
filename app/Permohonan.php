<?php

namespace App;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Permohonan extends Model
{
    protected $table = 'permohonan', $primaryKey = 'permohonan_id';
    public $timestamps = false;

    

    public static function getAll() {
        return self::select([
            'permohonan_id',
            'permohonan_penerima',
            'permohonan_pemohon',
            'permohonan_alamat',
            'permohonan_NIK',
            'permohonan_no_hp',
            'permohonan_jenis',
            'permohonan_status',
            'permohonan_diteruskan',
            'permohonan_selesai',
            'permohonan_masuk',
            'permohonan_masuk_operator'
        ]);
    }
    
}
