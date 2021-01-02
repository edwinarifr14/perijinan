<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukTableSeeder extends Seeder {


    public function run(){
        DB::table('kategori')->insert([
            [
                'kategori_nama' => 'Sayuran',
                'kategori_deskripsi' => 'Kategori Sayuran'
            ]
        ]);

        DB::table('kemasan')->insert([
            [
                'kemasan_kode' => 'KG',
                'kemasan_deskripsi' => 'Dijual per kilogram',
                'kemasan_gram' => '1000';
            ],
            [
                'kemasan_kode' => 'G',
                'kemasan_deskripsi' => 'Dijual per gram',
                'kemasan_gram' => '1';
            ]
        ]);
    }
}
