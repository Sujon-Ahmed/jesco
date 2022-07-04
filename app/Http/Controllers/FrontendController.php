<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use Illuminate\Http\Request;
use Psy\Readline\Hoa\Console;

class FrontendController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', '1')->get();
        $latest_categories = Category::latest()->take(4)->get();
        $latest_product = Product::latest()->get();
        $products = Product::orderBy('id', 'desc')->paginate(12);

        return view('frontend.index', [
            'categories' => $categories,
            'latest_categories' => $latest_categories,
            'products' => $products,
            'latest_product' => $latest_product,
        ]);
    }
    // single product page
    public function singleProduct($id)
    {
        $product_info = Product::find($id);
        return view('frontend.single-product', [
            'product_info' => $product_info,
        ]);
    }
    // filter category product
    public function filterCategoryProduct($id)
    {
        return 'ok';
        // $products = Product::where('category_id',$id)->get();
        // return view('frontend.index', [
        //     'products' => $products,
        // ]);
    }
}