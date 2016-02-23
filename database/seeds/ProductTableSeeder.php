<?php

use Illuminate\Database\Seeder;
use CodeDelivery\Models\Product;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Product::class, 18)->create();
    }
}
