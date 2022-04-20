<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    // size view
    public function size()
    {
        $sizes = Size::all();
        return view('backend.size.index', [
            'sizes' => $sizes,
        ]);
    }
    // size insert
    public function sizeInsert(Request $request)
    {
        Size::insert([
            'size' => $request->size,
            'created_at' => Carbon::now(),
        ]);
        return back();
    }
}
