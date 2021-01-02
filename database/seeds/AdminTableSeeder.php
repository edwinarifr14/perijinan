<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin')->insert([
            [
                'admin_username' => 'admin',
                'admin_nama' => 'Super Admin',
                'admin_password' => Hash::make('admin'),
                'admin_kontak' => '081271377018',
                'admin_level' => 1
            ],
            [
                'admin_username' => 'author',
                'admin_nama' => 'Admin',
                'admin_password' => Hash::make('author'),
                'admin_kontak' => '08188889999',
                'admin_level' => 2
            ]
        ]);
    }
}
