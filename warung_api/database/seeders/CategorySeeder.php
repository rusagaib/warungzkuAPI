<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('warungapi_categories')->insert([
        'name' => "Makanan & Minuman",
      ]);
      DB::table('warungapi_categories')->insert([
        'name' => "Sembako",
      ]);
      DB::table('warungapi_categories')->insert([
        'name' => "Alat Tulis",
      ]);
      DB::table('warungapi_categories')->insert([
        'name' => "Elektronik",
      ]);
      DB::table('warungapi_categories')->insert([
        'name' => "Paket Data",
      ]);
      DB::table('warungapi_categories')->insert([
        'name' => "Lain-Lain",
      ]);
    }
}
