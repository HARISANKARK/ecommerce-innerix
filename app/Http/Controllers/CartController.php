<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only(['category_id']);
        $carts = Cart::join('categories','carts.category_id','=','categories.c_id')
                ->join('products','carts.product_id','=','products.p_id')
                ->filter($filters)
                ->get();
        $categories = $this->commonService->categories();
        return view('cart.index',compact('carts','categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($id)
    {
        // Check The Product In Cart
        $check_cart = Cart::where('product_id',$id)->where('c_user_id',authUserId())->first();
        if($check_cart){
            return redirect()->back()->with('warning','Product Already Added To Cart');
        }

        // Store the previous URL before visiting the edit page
        session(['second_last_page' => url()->previous()]);

        try
        {
            $product = Product::find($id);

            $cart = new Cart;
            $cart->date = date('Y-m-d');
            $cart->category_id = $product->p_category_id;
            $cart->product_id = $product->p_id;
            $cart->c_user_id = authUserId();
            $cart->save();

            return redirect(session('second_last_page'))->with('success','Product Added to Cart Successfully');
        }
        catch (\Exception $e)
        {
            // Handle the exception
            Log::error('An error occurred In CategoryController: ' . $e->getMessage());
            // Validation failed
            return redirect()->back()->withInput()->with('danger','Something Went Wrong');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
