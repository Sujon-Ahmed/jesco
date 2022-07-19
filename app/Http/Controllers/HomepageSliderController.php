<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomepageSliderController extends Controller
{
    public function index()
    {
        return view('backend.homepage_sliders.index');
    }
}