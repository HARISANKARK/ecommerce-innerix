<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'p_name' => 'iPhone 14',
                'p_category_id' => 1, // Electronics
                'p_description' => 'Latest Apple smartphone with amazing features.',
                'p_qty' => 50,
                'p_rate' => 999.99,
                'p_image_path' => 'images/products/i-phone.jpg',
            ],
            [
                'p_name' => 'Nike Air Max',
                'p_category_id' => 2, // Clothing
                'p_description' => 'Comfortable and stylish running shoes.',
                'p_qty' => 100,
                'p_rate' => 199.99,
                'p_image_path' => 'images/products/nike_air_max.png',
            ],
            [
                'p_name' => 'The Alchemist',
                'p_category_id' => 3, // Books
                'p_description' => 'A masterpiece by Paulo Coelho.',
                'p_qty' => 200,
                'p_rate' => 15.99,
                'p_image_path' => 'images/products/the_alchemist.jpg',
            ],
            [
                'p_name' => 'Blender',
                'p_category_id' => 4, // Home Appliances
                'p_description' => 'High-speed blender for your kitchen needs.',
                'p_qty' => 30,
                'p_rate' => 89.99,
                'p_image_path' => 'images/products/blender.jpg',
            ],
        ];

        foreach ($products as $product) {
            DB::table('products')->insert([
                'p_name' => $product['p_name'],
                'p_category_id' => $product['p_category_id'],
                'p_description' => $product['p_description'],
                'p_qty' => $product['p_qty'],
                'p_rate' => $product['p_rate'],
                'p_image_path' => $product['p_image_path'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
