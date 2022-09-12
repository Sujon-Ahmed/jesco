<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Mockery\Expectation;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::get();
        return view('backend.blogs.index', [
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required | max:255',
            'category_id' => 'required',
            'thumbnail_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required'
        ]);
        try {
            $image = $request->thumbnail_image;
            $extension = $image->getClientOriginalExtension();
            $img_new_name = uniqid().'.'.$extension;
            $destination_path = public_path().'/backend_assets/uploads/blogs/';
            $image->move($destination_path,$img_new_name);

            Blog::create([
                'title' => $request->title,
                'category_id' => $request->category_id,
                'image' => $img_new_name,
                'description' => $request->description,
            ]);
            return back()->with('status', 'Blog Uploaded Successfully');
        } catch (Expectation $error) {
            return back()->with('error', 'Blog can not uploaded');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        //
    }
}
