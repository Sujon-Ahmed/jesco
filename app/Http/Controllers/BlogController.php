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
        $blogs = Blog::get();
        return view('backend.blogs.index', [
            'categories'    => $categories,
            'blogs'         => $blogs,
        ]);
    }
    // status change
    public function statusChange($id)
    {
        $blog = Blog::findOrFail(decrypt($id));
        if ($blog->status == 1) {
            $blog->status = 0;
            $blog->save();
            return back()->with('status', 'status pending');
        } else {
            $blog->status = 1;
            $blog->save();
            return back()->with('status', 'status approve');
        }
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
            $img_new_name = uniqid() . '.' . $extension;
            $destination_path = public_path() . '/backend_assets/uploads/blogs/';
            $image->move($destination_path, $img_new_name);

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
        return $blog;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        return $blog;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->thumbnail_image != '') {
            $blog = Blog::findOrFail(decrypt($id));
            $extension = $request->thumbnail_image->getClientOriginalExtension();
            $image_name = uniqid() . '.' . $extension;
            if ($blog->image != null) {
                unlink(public_path('/backend_assets/uploads/blogs/' . $blog->image));
                $request->thumbnail_image->move(public_path('/backend_assets/uploads/blogs/'), $image_name);
            } else {
                $request->thumbnail_image->move(public_path('/backend_assets/uploads/blogs/'), $image_name);
            }
            Blog::findOrFail(decrypt($id))->update([
                'image' => $image_name,
            ]);
            return back()->with('status', 'Blog Updated Successfully');
        }
        Blog::findOrFail(decrypt($id))->update([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'description' => $request->editDescription,
        ]);
        return back()->with('status', 'Blog Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog, $id)
    {
        $image = Blog::where('id', decrypt($id))->first()->image;
        if ($image != null) {
            $delete_from = public_path('/backend_assets/uploads/blogs/' . $image);
            unlink($delete_from);
            Blog::findOrFail(decrypt($id))->delete();
            return back()->with('status', 'Blog Delete Successfully');
        } else {
            Blog::findOrFail(decrypt($id))->delete();
            return back()->with('status', 'Blog Delete Successfully');
        }
    }
}
