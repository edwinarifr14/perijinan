<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanan', $primaryKey = 'pesanan_id';
    public $timestamps = false;
}
