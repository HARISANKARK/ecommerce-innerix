<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $filters = $request->only(['category_id']);
        $products = Product::join('categories','products.p_category_id','=','categories.c_id')
                ->filter($filters)
                ->get();
        $categories = Category::all();
        return view('home',compact('products','categories'));
    }
}
