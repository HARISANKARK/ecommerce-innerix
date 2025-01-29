<?php

namespace App\Http\Controllers;

use App\Models\Number;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only(['from','to','product_id','category_id']);

        $orders = Order::join('products','orders.product_id','=','products.p_id')
                ->join('categories','orders.category_id','=','categories.c_id')
                ->filter($filters)
                ->get();

        $products = $this->commonService->products();
        $categories = $this->commonService->categories();
        $from = $request->from ?? date('Y-m-d');
        $to = $request->to ?? date('Y-m-d');

        return view('order.index',compact('from','to','products','categories','orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        // Store the previous URL before visiting the edit page
        session(['second_last_page' => url()->previous()]);

        $product = Product::join('categories','products.p_category_id','=','categories.c_id')->find($id);
        return view('order.create',compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'category_id' => 'required|integer',
            'product_id' => 'required|integer',
            'qty' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'amount' => 'required|numeric|min:0',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'contact_no' => 'required|regex:/^[0-9]{10}$/',
            'lan_mark' => 'required|string|max:255',
        ]);

        try
        {
            $order_id = Number::first()->order_id ?? 1;

            $order = new Order;
            $order->date = $request->date;
            $order->order_id = $order_id;
            $order->category_id = $request->category_id;
            $order->product_id = $request->product_id;
            $order->name = $request->name;
            $order->address = $request->address;
            $order->contact_no = $request->contact_no;
            $order->lan_mark = $request->lan_mark;
            $order->qty = $request->qty;
            $order->price = $request->price;
            $order->amount = $request->amount;
            $order->o_status = 1;//order requested
            $order->o_user_id = authUserId();
            $order->save();

            // Update Order Id
            $number = Number::find(1);
            $number->order_id = ++$order_id;
            $number->save();

            return redirect(session('second_last_page'))->with('success','Order Added Successfully');
        }
        catch (\Exception $e)
        {
            // Handle the exception
            Log::error('An error occurred In OrderController: ' . $e->getMessage());
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

        $order = Order::join('products','orders.product_id','=','products.p_id')
                ->join('categories','orders.category_id','=','categories.c_id')
                ->find($id);

        $products = $this->commonService->products();
        $categories = $this->commonService->categories();

        return view('order.edit',compact('products','categories','order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'date' => 'required|date',
            'qty' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'amount' => 'required|numeric|min:0',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'contact_no' => 'required|regex:/^[0-9]{10}$/',
            'lan_mark' => 'required|string|max:255',
        ]);

        try
        {

            $order = Order::find($id);
            $order->date = $request->date;
            $order->name = $request->name;
            $order->address = $request->address;
            $order->contact_no = $request->contact_no;
            $order->lan_mark = $request->lan_mark;
            $order->qty = $request->qty;
            $order->price = $request->price;
            $order->amount = $request->amount;
            $order->save();

            return redirect(session('second_last_page'))->with('success','Order Updated Successfully');
        }
        catch (\Exception $e)
        {
            // Handle the exception
            Log::error('An error occurred In OrderController: ' . $e->getMessage());
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

        $order = Order::find($id)->delete();
        return redirect(session('second_last_page'))->with('success','Order Deleted Successfully');
    }
}
