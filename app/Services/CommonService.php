<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Product;

class CommonService
{
    public function categories()
    {
        $categories = Category::orderBy('c_name','asc')->get();
        return $categories;
    }

    public function products()
    {
        $products = Product::orderBy('p_name','asc')->get();
        return $products;
    }
}
