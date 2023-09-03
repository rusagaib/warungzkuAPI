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
      DB::table('categories')->insert([
        'name' => "Makanan & Minuman",
      ]);
      DB::table('categories')->insert([
        'name' => "Sembako",
      ]);
      DB::table('categories')->insert([
        'name' => "Alat Tulis",
      ]);
      DB::table('categories')->insert([
        'name' => "Elektronik",
      ]);
      DB::table('categories')->insert([
        'name' => "Paket Data",
      ]);
      DB::table('categories')->insert([
        'name' => "Lain-Lain",
      ]);
    }
}
