<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Size;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $colors = Color::all();
        $sizes = Size::all();
        return view('backend.product_attributes.product.index', [
            'categories' => $categories,
            'brands' => $brands,
            'colors' => $colors,
            'sizes' => $sizes,
        ]);
    }

    public function getCategory(Request $request)
    {
        $str_to_send = '<option value="" class="form-control">-- Select Category --</option>';
        foreach (Subcategory::where('category_id', $request->category_id)->get() as $subcategory) {
            $str_to_send .= '<option value="' . $subcategory->id . '">' . $subcategory->subcategory_name . '</option>';
        }
        echo $str_to_send;
    }

}