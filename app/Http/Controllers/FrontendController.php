<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', '1')->get();
        return view('frontend.index', [
            'categories' => $categories,
        ]);
    }
}
