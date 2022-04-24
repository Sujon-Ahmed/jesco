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
        return view('backend.product_attributes.color.index', [
            'colors' => $colors,
        ]);
    }
    // color insert 
    public function colorInsert(Request $request)
    {
        $validated = $request->validate([
            'color_name' => 'required|unique:colors|max:255',
            'color_code' => 'required|unique:colors',
        ]);
        Color::insert([
            'color_name' => $request->color_name,
            'color_code' => $request->color_code,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('status', 'color added successfully');
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
        $validated = $request->validate([
            'color_name' => 'required|max:255',
            'color_code' => 'required| max:255',
        ]);

        $color_id = $request->input('colorId');
        Color::find($color_id)->update([
            'color_name' => $request->color_name,
            'color_code' => $request->color_code,
        ]);
        return back()->with('status', 'color updated successfully!');
    }
    // color delete
    public function colorDelete(Request $request)
    {
        $colorId = $request->input('colorDeleteId');
        $color = Color::find($colorId);
        $color->delete();
        return back()->with('status', 'color deleted successfully');
    }
}
