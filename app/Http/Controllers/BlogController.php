<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $n['blogs'] = Blog::orderBy('id', 'desc')->get();
        return view('backend.pages.blog.index', $n);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBlogRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($request->title);
        $data['status'] = $request->status == true ? 1 : 0;

        // Blog
        if($request->hasFile('image')){
            $file = $request->file('image');
            $random = rand(100000, 999999);
            $name = time().'-'.$random.'.'.$file->getClientOriginalExtension();
            $path = $file->move(public_path('images/blogs'), $name);
            $data['image'] = 'images/blogs/'.$name;
        }

        // Author Image
        if($request->hasFile('author_image')){
            $file = $request->file('author_image');
            $random = rand(100000, 999999);
            $name = time().'-'.$random.'.'.$file->getClientOriginalExtension();
            $path = $file->move(public_path('images/blogs'), $name);
            $data['author_image'] = 'images/blogs/'.$name;
        }

        $insert = Blog::create($data);

        return $insert ? redirect()->route('blog.index')->with('success', 'Blog created successfully')
                : redirect()->back()->with('error', 'Blog creation failed');
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
        $n['blog'] = $blog;
        return view('backend.pages.blog.edit', $n);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBlogRequest  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($request->title);
        $data['status'] = $request->status == true ? 1 : 0;

        // Blog
        if($request->hasFile('image')){
            $file = $request->file('image');
            $random = rand(100000, 999999);
            $name = time().'-'.$random.'.'.$file->getClientOriginalExtension();
            $path = $file->move(public_path('images/blogs'), $name);
            $data['image'] = 'images/blogs/'.$name;

            // old image delete
            if($blog->image){
                Storage::delete('public/'.$blog->image);
            }
        }

        // Author Image
        if($request->hasFile('author_image')){
            $file = $request->file('author_image');
            $random = rand(100000, 999999);
            $name = time().'-'.$random.'.'.$file->getClientOriginalExtension();
            $path = $file->move(public_path('images/blogs'), $name);
            $data['author_image'] = 'images/blogs/'.$name;

            // old image delete
            if($blog->author_image){
                Storage::delete('public/'.$blog->author_image);
            }
        }

        $update = $blog->update($data);
        return $update ? redirect()->route('blog.index')->with('success', 'Blog updated successfully')
                : redirect()->back()->with('error', 'Blog update failed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $delete = $blog->delete();
        if($blog->image){
         unlink(public_path($blog->image));
        }
        if($blog->author_image){
            unlink(public_path($blog->author_image));
        }
        return $delete ? redirect()->route('blog.index')->with('success', 'Blog deleted successfully')
                : redirect()->back()->with('error', 'Blog deletion failed');
    }


}
