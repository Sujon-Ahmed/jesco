<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use Intervention\Image\ImageManagerStatic as Image;

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
}
