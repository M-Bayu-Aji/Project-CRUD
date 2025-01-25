<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Sepatu Ortus Seight',
            'price' => 300000,
            'stock' => 100,
            'image' => 'img/Sepatu Ortus Seight.jpg' // Assuming the image is in the public/images folder
        ]);
        Product::create([
            'name' => 'Topi',
            'price' => 50000,
            'stock' => 60,
            'image' => 'img/topi.jpeg' // Assuming the image is in the public/images folder
        ]);
        Product::create([
            'name' => 'Sweater',
            'price' => 100000,
            'stock' => 50,
            'image' => 'img/sweaterEdit.jpg' // Assuming the image is in the public/images folder
        ]);
    }
}
