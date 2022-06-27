<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Size;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Models\Product;
use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic as Image;

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
    // get category wise subcategory
    public function getCategory(Request $request)
    {
        $str_to_send = '<option value="" class="form-control">-- Select Category --</option>';
        foreach (Subcategory::where('category_id', $request->category_id)->get() as $subcategory) {
            $str_to_send .= '<option value="' . $subcategory->id . '">' . $subcategory->subcategory_name . '</option>';
        }
        echo $str_to_send;
    }
    // product store
    public function store(Request $request)
    {
        $product_id = Product::insertGetId([
            'product_name' => $request->product_name,
            'product_slug' => strtolower(str_replace(' ','-',$request->product_name)),
            'product_price' => $request->product_price,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'quantity' => $request->quantity,
            'sku' => $request->sku,
            'discount' => $request->discount,
            'after_discount' => $request->product_price - $request->product_price * $request->discount / 100,
            'brand_id' => $request->brand_id,
            'status' => $request->status,
            'tending' => $request->tending,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'created_at' => Carbon::now()
        ]);
        $product_image = $request->product_image;
        $product_image_extension = $product_image->getClientOriginalExtension();
        $product_image_name = $product_id.'.'.$product_image_extension;
        Image::make($product_image)->resize(270,310)->save(public_path('/backend_assets/uploads/products/preview/'.$product_image_name));
        Product::find($product_id)->update([
            'product_image' => $product_image_name
        ]);
        return redirect()->route('product')->with('status', 'Product has been added successfully');
    }

}