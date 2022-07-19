<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Size;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductThumbnail;
use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic as Image;

class ProductController extends Controller
{
    public function index()
    {
        $products   =  Product::all();
        $categories =  Category::all();
        $brands     =  Brand::all();
        $colors     =  Color::all();
        $sizes      =  Size::all();

        return view('backend.product_attributes.product.index', [
            'products'      => $products,
            'categories'    => $categories,
            'brands'        => $brands,
            'colors'        => $colors,
            'sizes'         => $sizes,
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
        $product = new Product();
        $product->product_name      = $request->product_name;
        $product->product_slug      = strtolower(str_replace(' ', '-', $request->product_name));
        $product->product_price     = $request->product_price;
        $product->category_id       = $request->category_id;
        $product->subcategory_id    = $request->subcategory_id;
        $product->quantity          = $request->quantity;
        // color id store
        $color_id = [];
        if ($request->color_id != null) {
            foreach ($request->color_id as $key => $color) {
                array_push($color_id, $color);
            }
        }
        $product->color_id          = json_encode($color_id);
        // size id store
        $size_id = [];
        if ($request->size_id != null) {
            foreach ($request->size_id as $key => $size) {
                array_push($size_id, $size);
            }
        }
        $product->size_id           = json_encode($size_id);

        $product->sku               = $request->sku;
        $product->discount          = $request->discount;
        $product->after_discount    = $request->product_price - $request->product_price * $request->discount / 100;
        $product->brand_id          = $request->brand_id;
        $product->status            = $request->status;
        $product->tending           = $request->tending;
        $product->short_description = $request->short_description;
        $product->description       = $request->description;
        // product image store
        $product_image              = $request->product_image;
        $product_image_extension    = $product_image->getClientOriginalExtension();
        $product_image_name         = uniqid().'.'.$product_image_extension;
        Image::make($product_image)->resize(800, 800)->save(public_path('/backend_assets/uploads/products/preview/'.$product_image_name));
        $product->product_image     = $product_image_name;

        $product->save();

        $loop = 1;
        foreach ($request->product_thumbnail as $thumbnail) {
            $thumbnail_extension =  $thumbnail->getClientOriginalExtension();
            $thumbnail_name = $product->id . '-' . $loop . '.' . $thumbnail_extension;
            Image::make($thumbnail)->resize(800, 800)->save(public_path('/backend_assets/uploads/products/thumbnails/' . $thumbnail_name));
            ProductThumbnail::insert([
                'product_id' => $product->id,
                'product_thumbnail' => $thumbnail_name,
                'created_at' => Carbon::now(),
            ]);
            $loop++;
        }
        return redirect()->route('product')->with('status', 'Product has been added successfully');
    }

}