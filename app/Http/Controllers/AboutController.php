<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        return view('frontend.about',[
            'brands' => $brands,
        ]);
    }
}