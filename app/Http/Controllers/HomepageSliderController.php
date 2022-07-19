<?php

namespace App\Http\Controllers;

use App\Models\HomepageSlider;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class HomepageSliderController extends Controller
{
    public function index()
    {
        return view('backend.homepage_sliders.index');
    }
    // store slider
    public function store(Request $request)
    {
        $slider = new HomepageSlider();
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
}