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
        return view('backend.product_attributes.size.index', [
            'sizes' => $sizes,
        ]);
    }
    // size insert
    public function sizeInsert(Request $request)
    {
        $validated = $request->validate([
            'size' => 'required|unique:sizes|max:255',
        ]);
        Size::insert([
            'size' => $request->size,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('status', 'size added successfully!');
    }
    // size edit
    public function edit($id)
    {
        $size_info = Size::find($id);
        return response()->json([
            'status' => 200,
            'size_info' => $size_info,
        ]);
    }
    public function update(Request $request)
    {
        $validated = $request->validate([
            'size' => 'required',
        ]);

        $size_id = $request->input('sizeId');
        Size::find($size_id)->update([
            'size' => $request->size,
        ]);
        return back()->with('status', 'size updated successfully!');
    }
    // size delete
    public function sizeDestroy(Request $request)
    {
        $size_id = $request->input('sizeDeleteId');
        $size = Size::find($size_id);
        $size->delete();
        return back()->with('status', 'size deleted successfully!');
    }
}
