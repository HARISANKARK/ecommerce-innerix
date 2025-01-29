<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ApiController extends Controller
{
    public function Categories()
    {
        $categories = Category::all();

        // Check if category exists
        if(!$categories){
            return response()->json([
                'message' => "Categories Not Found"
            ],404);
        }

        // Return category details
        return response()->json([
            'message' => "Categories Retrived Successfully",
            'data' => $categories
        ],200);
    }

    public function Products(Request $request)
    {
        $products = Product::join('categories','products.p_category_id','=','categories.c_id')
            ->orderBy('p_name','asc');
        if($request->category_id){
            $products = $products->where('p_category_id',$request->category_id);
        }
        if($request->name){
            $products = $products->where('p_name',$request->name);
        }
        if($request->lower_price){
            $products = $products->where('p_price','>=',$request->lower_price);
        }
        if($request->higher_price){
            $products = $products->where('p_price','<=',$request->higher_price);
        }
        $products = $products->get();

        // Check if product exists
        if(!$products){
            return response()->json([
                'message' => "Products Not Found"
            ],404);
        }

        // Return product details
        return response()->json([
            'message' => "Products Retrived Successfully",
            'data' => $products
        ],200);
    }

    public function Carts()
    {
        $carts = Cart::join('categories','carts.category_id','=','categories.c_id')
            ->join('products','carts.product_id','=','products.p_id')
            ->orderBy('ct_id','desc')
            ->get();

        // Check if cart exists
        if(empty($carts)){
            return response()->json([
                'message' => "Carts Not Found"
            ],404);
        }

        // Return cart details
        return response()->json([
            'message' => "Carts Retrived Successfully",
            'data' => $carts
        ],200);
    }
}
