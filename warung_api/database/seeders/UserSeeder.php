<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('warungapi_users')->insert([
        'name' => "Admin",
        'email' => "admin_warungku@example.com",
        'password' => Hash::make('password'),
        'roleId' => 1,
        'status' => 0 
      ]);
      DB::table('warungapi_users')->insert([
        'name' => "pegawaiOne",
        'email' => "pegawai1warungku@example.com",
        'password' => Hash::make('password'),
        'roleId' => 2, 
        'status' => 0, 
      ]);

    }
}
