<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Products;
use Illuminate\Database\Eloquent\Factories\Factory;


class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
   
        Products::factory()->count(20)->create();
    }
}
