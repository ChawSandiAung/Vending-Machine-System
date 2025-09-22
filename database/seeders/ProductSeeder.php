<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'name' => 'Coke',
            'price' => 3.990,
            'quantity_available' => 100,
        ]);

        Product::create([
            'name' => 'Pepsi',
            'price' => 6.885,
            'quantity_available' => 100,
        ]);

        Product::create([
            'name' => 'Water',
            'price' => 0.500,
            'quantity_available' => 100,
        ]);
    }
}
