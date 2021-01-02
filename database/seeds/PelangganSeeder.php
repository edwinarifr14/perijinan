<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PelangganSeeder extends Seeder {
    public function run(){
        DB::table('pelanggan')->insert([
            [
                'pelanggan_email'=>'a@a.com',
                'pelanggan_password'=> Hash::make('1234'),
                'pelanggan_nama'=>'pelanggan a',
                'pelanggan_kontak'=>'231312341234',
                'pelanggan_alamat'=>'alamat pelanggan a'                      
            ],
            [
                'pelanggan_email'=>'b@a.com',
                'pelanggan_password'=> Hash::make('1234'),
                'pelanggan_nama'=>'pelanggan b',
                'pelanggan_kontak'=>'231312341234',
                'pelanggan_alamat'=>'alamat pelanggan b'                      
            ]
        ]);
    }
}