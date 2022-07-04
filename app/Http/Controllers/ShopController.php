<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $colors = Color::all();
        $sizes = Size::all();
        return view('frontend.shop', [
            'categories' => $categories,
            'colors' => $colors,
            'sizes' => $sizes,
        ]);
    }
}