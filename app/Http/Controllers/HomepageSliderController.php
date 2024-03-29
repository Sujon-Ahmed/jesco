<?php

namespace App\Http\Controllers;

use App\Models\HomepageSlider;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Laravel\Ui\Presets\React;

class HomepageSliderController extends Controller
{
    public function index()
    {
        $sliders = HomepageSlider::all();
        return view('backend.homepage_sliders.index', compact('sliders'));
    }
    // store slider
    public function store(Request $request)
    {
        $slider             = new HomepageSlider();
        $slider->sub_title  = $request->sub_title;
        $slider->title      = $request->title;
        // store slider image
        $slider_image       = $request->image;
        $slider_image_ext   = $slider_image->getClientOriginalExtension();
        $slider_image_name  = uniqid().'.'.$slider_image_ext;
        Image::make($slider_image)->resize(472,634)->save(public_path('/backend_assets/uploads/slider/'.$slider_image_name));
        $slider->image      = $slider_image_name;
        $slider->save();
        return redirect()->route('slider')->with('status', 'Slider has been added successfully');
    }
    // get banner slider information
    public function GetBanner($id)
    {
        $data = HomepageSlider::find($id);
        return response()->json([
            'data' => $data
        ]);
    }
    // update banner slider
    public function update(Request $request)
    {
        if ($request->modify_image != '') {
            $slider_info = HomepageSlider::find($request->sliderId);
            if ($slider_info->image != '') {
                unlink(public_path('/backend_assets/uploads/slider/'.$slider_info->image));
            }
            $slider_banner_name = $request->sliderId.'.'.$request->modify_image->getClientOriginalExtension();
            Image::make($request->modify_image)->resize(472, 634)->save(public_path('/backend_assets/uploads/slider/' . $slider_banner_name));
            HomepageSlider::find($request->sliderId)->update([
                'image' => $slider_banner_name,
            ]);
        }
        HomepageSlider::find($request->sliderId)->update([
            'sub_title' => $request->modify_sub_title,
            'title'     => $request->modify_title,
        ]);
        return back()->with('status', 'slider updated successfully!');
    }
    // destroy slider banner
    public function destroy(Request $request)
    {
        $slider_id = $request->slider_id;
        $slider_image = HomepageSlider::where('id', $slider_id)->first()->image;
        $delete_form = public_path('/backend_assets/uploads/slider/'.$slider_image);
        unlink($delete_form);
        HomepageSlider::find($slider_id)->delete();
        return back()->with('status', 'Slider Delete Successfully!');
    }
    // update slider status
    public function statusUpdate(Request $request)
    {
        $slider = HomepageSlider::find($request->id);
        $slider->status = $request->slider_status;
        $slider->save();
        return 1;
    }
}
