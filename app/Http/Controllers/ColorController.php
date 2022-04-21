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
        return response()->json([
            'status' => 200,
            'color_info' => $color_info,
        ]);
    }
    // color update
    public function colorUpdate(Request $request)
    {
        $color_id = $request->input('colorId');
        Color::find($color_id)->update([
            'color_name' => $request->color_name,
            'color_code' => $request->color_code,
        ]);
        return redirect()->route('color');
    }
    // color delete
    public function colorDelete(Request $request)
    {
        $colorId = $request->input('colorDeleteId');
        $color = Color::find($colorId);
        $color->delete();
        return back();
    }
}
