<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $total_products = Product::all()->count();
        $categories = Category::all();
        $colors = Color::all();
        $sizes = Size::all();
        $sort_text = '';
        if ($request->sort != null) {
            $sort = $request->sort;
            if ($sort === 'default') {
                $sort_text = 'default';
                $products = Product::orderBy('id', 'desc')->paginate(12);
            } else if ($sort === 'newest') {
                $sort_text = 'newest';
                $products = Product::orderBy('created_at', 'DESC')->paginate(12);
            } else if ($sort === 'oldest') {
                $sort_text = 'oldest';
                $products = Product::orderBy('created_at', 'ASC')->paginate(12);
            } else if ($sort === 'low-to-high') {
                $sort_text = 'low-to-high';
                $products = Product::orderBy('product_price', 'ASC')->paginate(12);
            } else if ($sort === 'high-to-low') {
                $sort_text = 'high-to-low';
                $products = Product::orderBy('product_price', 'DESC')->paginate(12);
            }
        } else {
            $products = Product::orderBy('id', 'desc')->paginate(12);
        }
        return view('frontend.shop', [
            'sort_text' => $sort_text,
            'categories' => $categories,
            'colors' => $colors,
            'sizes' => $sizes,
            'products' => $products,
            'total_products' => $total_products,
        ]);
    }
    // filter category product
    public function filterCategoryProduct(Request $request, $id)
    {
        $total_products = Product::all()->count();
        $categories = Category::all();
        $colors = Color::all();
        $sizes = Size::all();
        $sort_text = '';
        if ($request->sort != null) {
            $sort = $request->sort;
            if ($sort === 'default') {
                $sort_text = 'default';
                $products = Product::orderBy('id', 'desc')->where('category_id', decrypt($id))->paginate(12);
            } else if ($sort === 'newest') {
                $sort_text = 'newest';
                $products = Product::orderBy('created_at', 'DESC')->where('category_id', decrypt($id))->paginate(12);
            } else if ($sort === 'oldest') {
                $sort_text = 'oldest';
                $products = Product::orderBy('created_at', 'ASC')->where('category_id', decrypt($id))->paginate(12);
            } else if ($sort === 'low-to-high') {
                $sort_text = 'low-to-high';
                $products = Product::orderBy('product_price', 'ASC')->where('category_id', decrypt($id))->paginate(12);
            } else if ($sort === 'high-to-low') {
                $sort_text = 'high-to-low';
                $products = Product::orderBy('product_price', 'DESC')->where('category_id', decrypt($id))->paginate(12);
            }
        } else {
            $products = Product::orderBy('id', 'desc')->where('category_id', decrypt($id))->paginate(12);
        }

        return view('frontend.shop', [
            'sort_text' => $sort_text,
            'categories' => $categories,
            'colors' => $colors,
            'sizes' => $sizes,
            'products' => $products,
            'total_products' => $total_products,
        ]);
    }
}
