<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
}
