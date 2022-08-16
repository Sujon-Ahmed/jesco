<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class AdminDashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('backend.index');
    }
    public function category()
    {
        return view('backend.category.index');
    }
    function clearCache(Request $request)
    {
        Artisan::call('cache:clear');
        return back()->with('status', 'Cache Cleared Successfully');
    }
}
