<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function GetProducts(Request $request)
    {
        $products = Product::where('p_category_id',$request->category_id)->get();
        return $products;
    }

    public function index(Request $request)
    {
        $filters = $request->only(['category_id']);
        $products = Product::join('categories','products.p_category_id','=','categories.c_id')
                ->filter($filters)
                ->get();
        $categories = $this->commonService->categories();
        return view('product.index',compact('products','categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->commonService->categories();
        return view('product.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' =>'required',
            'qty' =>'required|numeric',
            'previous_price' =>'required',
            'price' => 'required',
            'discount_per' => 'required',
            'description' => 'required|string|max:1000',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try
        {
            $product = new Product;
            $product->p_name = $request->name;
            $product->p_category_id = $request->category_id;
            $product->p_qty = $request->qty;
            $product->p_previous_price = $request->previous_price;
            $product->p_price = $request->price;
            $product->p_discount_per = $request->discount_per;
            $product->p_description = $request->description;

            // Store image in the 'public/images/product' directory
            $imageName = time() . '.' . $request->image->extension();
            $path = 'images/products/';
            $request->image->move(public_path($path), $imageName);
            $filte_path = $path.$imageName;

            $product->p_image_path = $filte_path;
            $product->p_user_id = authUserId();
            $product->save();

            return redirect()->back()->with('success','Product Added Successfully');
        }
        catch (\Exception $e)
        {
            // Handle the exception
            Log::error('An error occurred In ProductController: ' . $e->getMessage());
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
        // Store the previous URL before visiting the edit page
        session(['second_last_page' => url()->previous()]);

        $product = Product::join('categories','products.p_category_id','=','categories.c_id')
                ->find($id);
        $categories = $this->commonService->categories();
        return view('product.edit',compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' =>'required',
            'qty' =>'required|numeric',
            'previous_price' =>'required',
            'price' => 'required',
            'discount_per' => 'required',
            'description' => 'required|string|max:1000',
        ]);

        try
        {
            $product = Product::find($id);
            $product->p_name = $request->name;
            $product->p_category_id = $request->category_id;
            $product->p_qty = $request->qty;
            $product->p_previous_price = $request->previous_price;
            $product->p_price = $request->price;
            $product->p_discount_per = $request->discount_per;
            $product->p_description = $request->description;

            // Validate and upload new image if present
            if ($request->hasFile('image')) {
                $request->validate([
                    'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);

                // Delete the image from the server
                $imagePath = public_path($product->p_image_path);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }

                // Store new image
                $imageName = time() . '.' . $request->image->extension();
                $path = 'images/products/';
                $request->image->move(public_path($path), $imageName);
                $filte_path = $path.$imageName;
                $product->p_image_path = $filte_path;
            }

            $product->save();

            return redirect(session('second_last_page'))->with('success','Product Updated Successfully');
        }
        catch (\Exception $e)
        {
            // Handle the exception
            Log::error('An error occurred In ProductController: ' . $e->getMessage());
            // Validation failed
            return redirect()->back()->withInput()->with('danger','Something Went Wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Store the previous URL before visiting the edit page
        session(['second_last_page' => url()->previous()]);

        $product = Product::find($id)->delete();
        return redirect(session('second_last_page'))->with('success','Product Deleted Successfully');
    }
}
