<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('warungapi_products')->insert([
        'name' => "Teh Gelas cup",
        'categoryId' => 1,
        'price' => 1000,
        'quantity' => 24,
        'status' => 0
      ]);
      DB::table('warungapi_products')->insert([
        'name' => "Head & Shoulder sacet",
        'categoryId' => 2,
        'price' => 1000,
        'quantity' => 12,
        'status' => 0
      ]);
    }
}
