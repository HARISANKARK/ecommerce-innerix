<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    public function login(Request $request)
    {
        // Validate the request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Retrieve user by email
        $user = User::where('email', $request->email)->first();

        // Check if the user exists and the password matches
        if ($user && Hash::check($request->password, $user->password)) {
            // Return the user in JSON format
            return response()->json([
                'message' => "User found Successfully",
                'data' => $user
            ],200);
        } else {
            // Return an error response
            return response()->json([
                'message' => 'Invalid credentials',
            ], 401);
        }
    }

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
        if(!$carts){
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

    public function Orders()
    {
        $orders = Order::join('categories','orders.category_id','=','categories.c_id')
            ->join('products','orders.product_id','=','products.p_id')
            ->orderBy('o_id','desc')
            ->get();

        // Check if cart exists
        if(!$orders){
            return response()->json([
                'message' => "Orders Not Found"
            ],404);
        }

        // Return cart details
        return response()->json([
            'message' => "Orders Retrived Successfully",
            'data' => $orders
        ],200);
    }
}
