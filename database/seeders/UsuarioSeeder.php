<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=> 'mike trujillo',
            'email'=> 'correo@correo.com',
            'password'=> Hash::make('123456789'),
            'url'=> 'http//:ticdwem.com',
            'created_at'=> date('Y-m-d H:i:s'),
            'updated_at'=> date('Y-m-d H:i:s')
        ]);
        DB::table('users')->insert([
            'name'=> 'Mariana Barros',
            'email'=> 'correo1@correo.com',
            'password'=> Hash::make('123456789'),
            'url'=> 'http//:ticdwemBarros.com',
            'created_at'=> date('Y-m-d H:i:s'),
            'updated_at'=> date('Y-m-d H:i:s')
        ]);
    }
}
