<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\subcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $subcategories = subcategory::all();
        return view('backend.product_attributes.sub_category.index', [
            'categories' => $categories,
            'subcategories' => $subcategories,
        ]);
    }
    // store 
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'subcategory_name' => 'required',
        ]);
        if (subcategory::where('category_id', $request->category_id)->where('subcategory_name', $request->subcategory_name)->exists()) {
            return back()->with('error', 'This Subcategory already exists!');
        } else {

            subcategory::insert([
                'category_id' => $request->category_id,
                'subcategory_name' => $request->subcategory_name,
                'created_at' => Carbon::now(),
            ]);
            return back()->with('status', 'subcategory added successfully!');
        }
    }
    // edit
    public function edit($id)
    {

        $subcategory_info = subcategory::find($id);
        return response()->json([
            'status' => 200,
            'subcategory_info' => $subcategory_info,
        ]);
    }
    // update 
    public function update(Request $request)
    {
        $request->validate([
            'category_id_updated' => 'required',
            'subcategory_name_updated' => 'required',
        ]);

       if (subcategory::where('category_id', $request->category_id_updated)->where('subcategory_name', $request->subcategory_name_updated)->exists()) {
           return back()->with('error', 'This Subcategory Already Exists!');
       } else {
           subcategory::find($request->updatedSubcategoryId)->update([
               'category_id' => $request->category_id_updated,
               'subcategory_name' => $request->subcategory_name_updated,
            ]);
            return back()->with('status', 'subcategory updated successfully!');
        }   
    }
    // destroy
    public function destroy(Request $request)
    {
        $subcategory_id = $request->input('subcategory_id');
        subcategory::find($subcategory_id)->delete();
        return back()->with('status', 'subcategory deleted successfully!');
    }
}
