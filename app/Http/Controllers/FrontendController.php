<?php

namespace App\Http\Controllers;

use App\Models\Blog;
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
        $latest_categories  = Category::where('status', '1')->latest()->take(4)->get();
        $latest_product     = Product::latest()->get();
        $products           = Product::latest()->take(12)->get();
        $sliders            = HomepageSlider::where('status', 1)->get();
        $blogs              = Blog::where('status', 1)->latest()->limit(3)->get();

        return view('frontend.index', [
            'sliders'           =>  $sliders,
            'categories'        =>  $categories,
            'latest_categories' =>  $latest_categories,
            'products'          =>  $products,
            'latest_product'    =>  $latest_product,
            'blogs'             =>  $blogs,
        ]);
    }
    // single product page
    public function singleProduct($id)
    {
        $product_info       = Product::find(decrypt($id));
        $related_products   = Product::where('category_id', $product_info->category_id)->where('id', '!=',  decrypt($id))->get();
        $product_info       = Product::find(decrypt($id));

        return view('frontend.single-product', [
            'product_info'      =>  $product_info,
            'related_products'  =>  $related_products,
        ]);
    }
    // blog grid
    public function blogsGrid()
    {
        $blogs  = Blog::where('status', 1)->latest()->paginate(15);
        return view('frontend.blogs', compact('blogs'));
    }
    // single blog
    public function singleBlog($id)
    {
        $blog = Blog::findOrFail(decrypt($id));
        return view('frontend.single-blog', compact('blog'));
    }

}
