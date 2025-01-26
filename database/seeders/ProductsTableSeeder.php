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
                'p_previous_price' => 1200, // Add default value if not provided
                'p_price' => 999.99,
                'p_discount_per' => 10, // Add default value if not provided
                'p_image_path' => 'images/products/i-phone.jpg',
                'p_user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'p_name' => 'Nike Air Max',
                'p_category_id' => 2, // Clothing
                'p_description' => 'Comfortable and stylish running shoes.',
                'p_qty' => 100,
                'p_previous_price' => 350,
                'p_price' => 199.99,
                'p_discount_per' => 20,
                'p_image_path' => 'images/products/nike_air_max.png',
                'p_user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'p_name' => 'The Alchemist',
                'p_category_id' => 3, // Books
                'p_description' => 'A masterpiece by Paulo Coelho.',
                'p_qty' => 200,
                'p_previous_price' => 30,
                'p_price' => 15.99,
                'p_discount_per' => 48,
                'p_image_path' => 'images/products/the_alchemist.jpg',
                'p_user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'p_name' => 'Blender',
                'p_category_id' => 4, // Home Appliances
                'p_description' => 'High-speed blender for your kitchen needs.',
                'p_qty' => 30,
                'p_previous_price' => 110,
                'p_price' => 89.99,
                'p_discount_per' => 30,
                'p_image_path' => 'images/products/blender.jpg',
                'p_user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert data into the products table
        DB::table('products')->insert($products);
    }
}
