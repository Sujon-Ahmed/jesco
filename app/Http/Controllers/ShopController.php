<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $total_products = Product::all()->count();
        $categories = Category::all();
        $colors = Color::all();
        $sizes = Size::all();
        $products = Product::orderBy('id', 'desc')->paginate(12);
        return view('frontend.shop', [
            'categories' => $categories,
            'colors' => $colors,
            'sizes' => $sizes,
            'products' => $products,
            'total_products' => $total_products,
        ]);
    }
    // filter category product
    public function filterCategoryProduct($id)
    {
        $total_products = Product::all()->count();
        $categories = Category::all();
        $colors = Color::all();
        $sizes = Size::all();
        $products = Product::orderBy('id', 'desc')->where('category_id', $id)->paginate(12);

        return view('frontend.shop', [
            'categories' => $categories,
            'colors' => $colors,
            'sizes' => $sizes,
            'products' => $products,
            'total_products' => $total_products,
        ]);
    }
}
