<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    // color view
    public function color()
    {
        $colors = Color::all();
        return view('backend.color.index', [
            'colors' => $colors,
        ]);
    }
    // color insert 
    public function colorInsert(Request $request)
    {
        Color::insert([
            'color_name' => $request->color_name,
            'color_code' => $request->color_code,
            'created_at' => Carbon::now(),
        ]);
        return back();
    }
    // color edit
    public function colorEdit($id)
    {
        $color_info = Color::find($id);
        return view('backend.color.edit', [
            'color_info' => $color_info,
        ]);
    }
    // color update
    public function colorUpdate(Request $request)
    {
        Color::find($request->id)->update([
            'color_name' => $request->color_name,
            'color_code' => $request->color_code,
        ]);
        return redirect()->route('color');
    }
    // color delete
    public function colorDelete($id)
    {
        Color::find($id)->delete();
        return back();
    }
}
