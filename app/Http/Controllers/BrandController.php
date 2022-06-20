<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Intervention\Image\ImageManagerStatic as Image;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        return view('backend.brands.index', compact('brands'));
    }
    public function store(Request $request)
    {
        $brand_id = Brand::insertGetId([
            'brand_name' => $request->brand_name,
            'created_at' => Carbon::now(),
        ]);

        $brand_thumbnail = $request->brand_thumbnail;
        $extension = $brand_thumbnail->getClientOriginalExtension();
        $thumbnail_name = $brand_id . '.' . $extension;
        Image::make($brand_thumbnail)->resize(480, 480)->save(public_path('/backend_assets/uploads/brands/' . $thumbnail_name));

        Brand::find($brand_id)->update([
            'brand_image' => $thumbnail_name,
        ]);
        return back()->with('status', 'Brand added successfully');
    }
}
