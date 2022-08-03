<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $brands = Brand::where('status', 1)->get();
        return view('frontend.about',[
            'brands' => $brands,
        ]);
    }
}
