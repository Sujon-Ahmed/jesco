<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Filesystem\Cache;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('backend.product_attributes.category.index', [
            'categories' => $categories,
        ]);
    }
    // add category
    public function add(CategoryRequest $request)
    {
        $category_id = Category::insertGetId([
            'category_name' => $request->category_name,
            'created_at' => Carbon::now(),
        ]);

        $category_thumbnail = $request->category_thumbnail;
        $extension = $category_thumbnail->getClientOriginalExtension();
        $thumbnail_name = $category_id.'.'.$extension;
        Image::make($category_thumbnail)->resize(480, 480)->save(public_path('/backend_assets/uploads/category/'.$thumbnail_name));

        Category::find($category_id)->update([
            'category_thumbnail' => $thumbnail_name,
        ]);
        return back()->with('status', 'category added successfully');

    }
    // edit
    public function edit($id)
    {
        $category_info = Category::find($id);
        return response()->json([
            'status' => 200,
            'category_info' => $category_info,
        ]);
    }
    // update
    public function update(Request $request)
    {
        if ($request->category_edit_thumbnail != '') {
            $category_info = Category::find($request->editUpdateCategoryId);
            if ($category_info->category_thumbnail != '') {
                unlink(public_path('/backend_assets/uploads/category/'.$category_info->category_thumbnail));
            }
            $thumbnail_name = $request->editUpdateCategoryId.'.'.$request->category_edit_thumbnail->getClientOriginalExtension();
            Image::make($request->category_edit_thumbnail)->resize(480, 480)->save(public_path('/backend_assets/uploads/category/'.$thumbnail_name));
            Category::find($request->editUpdateCategoryId)->update([
                'category_thumbnail' => $thumbnail_name,
            ]);
        }
        Category::find($request->editUpdateCategoryId)->update([
            'category_name' => $request->category_edit_name,
        ]);
        return back()->with('status', 'category updated successfully!');
    }
    // delete category
    public function destroy(Request $request)
    {
        $category_id = $request->category_id;
        $category_thumbnail = Category::where('id', $category_id)->first()->category_thumbnail;
        $delete_form = public_path('/backend_assets/uploads/category/'.$category_thumbnail);
        unlink($delete_form);
        Category::find($category_id)->delete();
        return back()->with('status', 'category delete successfully!');
    }
    // update status
    public function status_update(Request $request)
    {
        $category = Category::find($request->id);
        $category->status = $request->category_status;
        $category->save();
        return 1;
    }
}
