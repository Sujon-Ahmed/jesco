<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', '1')->get();
        $products = Product::all();
        return view('frontend.index', [
            'categories' => $categories,
            'products' => $products,
        ]);
    }
}
