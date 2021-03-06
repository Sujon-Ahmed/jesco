<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\HomepageSlider;
use App\Models\Product;
use Illuminate\Http\Request;
use Psy\Readline\Hoa\Console;

class FrontendController extends Controller
{
    public function index()
    {
        $categories         = Category::where('status', '1')->get();
        $latest_categories  = Category::latest()->take(4)->get();
        $latest_product     = Product::latest()->get();
        $products           = Product::orderBy('id', 'desc')->paginate(12);
        $sliders            = HomepageSlider::all();

        return view('frontend.index', [
            'sliders'           =>  $sliders,
            'categories'        =>  $categories,
            'latest_categories' =>  $latest_categories,
            'products'          =>  $products,
            'latest_product'    =>  $latest_product,
        ]);
    }
    // single product page
    public function singleProduct($id)
    {
        $product_info       = Product::find($id);
        $related_products   = Product::where('category_id', $product_info->category_id)->where('id', '!=',  $id)->get();
        $product_info       = Product::find($id);

        return view('frontend.single-product', [
            'product_info'      =>  $product_info,
            'related_products'  =>  $related_products,
        ]);
    }

}