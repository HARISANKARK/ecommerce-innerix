<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        try
        {
            $category = new Category;
            $category->c_name = $request->name;
            $category->save();

            return redirect()->back()->with('success','Category Added Successfully');
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
        $category = Category::find($id);
        return view('category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        try
        {
            $category = Category::find($id);
            $category->c_name = $request->name;
            $category->save();

            return redirect()->route('categories.index')->with('success','Category Updated Successfully');
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id)->delete();
        return redirect()->route('categories.index')->with('success','Category Deleted Successfully');
    }
}
