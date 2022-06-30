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
        $latest_categories = Category::latest()->take(4)->get();
        $latest_product = Product::latest()->get();
        $products = Product::all();
        
        return view('frontend.index', [
            'categories' => $categories,
            'latest_categories' => $latest_categories,
            'products' => $products,
            'latest_product' => $latest_product,
        ]);
    }
}