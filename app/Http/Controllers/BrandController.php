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
    public function delete(Request $request)
    {
        $brand_id = $request->deleted_brand_id;
        $brand_thumbnail = Brand::where('id', $brand_id)->first()->brand_image;
        $delete_form = public_path('backend_assets/uploads/brands/' . $brand_thumbnail);
        unlink($delete_form);
        Brand::find($brand_id)->delete();
        return redirect()->route('brands')->with('status', 'Brand Delete Successfully!');
    }
    public function getBrandInformation($id)
    {
        $brand_info = Brand::find($id);
        return response()->json([
            'status' => 200,
            'brand_info' => $brand_info,
        ]);
    }
    public function update(Request $request)
    {
        if ($request->edited_brand_image != '') {
            $brand_info = Brand::find($request->edited_brand_id);
            if ($brand_info->brand_image != '') {
                unlink(public_path('/backend_assets/uploads/brands/' . $brand_info->brand_image));
            }
            $thumbnail_name = $request->edited_brand_id . '.' . $request->edited_brand_image->getClientOriginalExtension();
            Image::make($request->edited_brand_image)->resize(480, 480)->save(public_path('/backend_assets/uploads/brands/' . $thumbnail_name));
            Brand::find($request->edited_brand_id)->update([
                'brand_image' => $thumbnail_name,
            ]);
        }
        Brand::find($request->edited_brand_id)->update([
            'brand_name' => $request->edited_brand_name,
        ]);
        return back()->with('status', 'category updated successfully!');
    }
    // update brand status
    function statusUpdate(Request $request)
    {
        $brand = Brand::find($request->id);
        $brand->status = $request->brand_status;
        $brand->save();
        return 1;
    }
}
