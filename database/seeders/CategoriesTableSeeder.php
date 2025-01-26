<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['c_name' => 'Electronics'],
            ['c_name' => 'Clothing'],
            ['c_name' => 'Books'],
            ['c_name' => 'Home Appliances'],
            ['c_name' => 'Sports Equipment'],
            ['c_name' => 'Toys'],
            ['c_name' => 'Furniture'],
            ['c_name' => 'Beauty & Personal Care'],
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'c_name' => $category['c_name'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
