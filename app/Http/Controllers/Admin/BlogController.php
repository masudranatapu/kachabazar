<?php

namespace App\Http\Controllers\Admin;

use App\Blog;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::latest()->paginate(15);
        $title = "Blog";
        return view('admin.blog',compact('blogs','title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required|max:150',
            'slug' => 'required|max:150|unique:blogs',
            'cover_photo' => 'nullable|mimes:jpeg,webp,gif,png,jpg',
        ]);

        // for cover photo
        $cover_photo = $request->file('cover_photo');
        $slug = $request->slug;
        if (isset($cover_photo))
        {
            //make unique name for cover_photo
            $currentDate = Carbon::now()->toDateString();
            $cimagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$cover_photo->getClientOriginalExtension();
            //check blog dir is exists
            if (!Storage::disk('public')->exists('blog'))
            {
                Storage::disk('public')->makeDirectory('blog');
            }
            // resize cover_photo for blog and upload
            $resize_image = Image::make($cover_photo)->resize(700,800,function ($constraint) {
                                                            $constraint->aspectRatio();
                                                        })->stream();
            Storage::disk('public')->put('blog/'.$cimagename,$resize_image);

        } else {
            $cimagename = null;
        }

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->slug = $request->slug;
        $blog->short_description = $request->short_description;
        $blog->description = $request->description;
        $blog->cover_photo = $cimagename;
        $blog->save();

        Toastr::success('Blog successfully saved.' ,'Success');
        return redirect()->back();

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        return view('admin.blog_update',compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        $this->validate($request,[
            'title' => 'required|max:150',
            'slug' => 'required|max:150',
            'cover_photo' => 'nullable|mimes:jpeg,webp,gif,png,jpg',
        ]);

        // for cover photo
        $cover_photo = $request->file('cover_photo');
        $slug = $request->slug;
        if (isset($cover_photo))
        {
            //make unique name for cover_photo
            $currentDate = Carbon::now()->toDateString();
            $cimagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$cover_photo->getClientOriginalExtension();
            //check blog dir is exists
            if (!Storage::disk('public')->exists('blog'))
            {
                Storage::disk('public')->makeDirectory('blog');
            }

            //delete old cover_photo
            if (Storage::disk('public')->exists('blog/'.$blog->cover_photo))
            {
               Storage::disk('public')->delete('blog/'.$blog->cover_photo);
            }

            // resize cover_photo for blog and upload
            $resize_image = Image::make($cover_photo)->resize(700,800,function ($constraint) {
                                                            $constraint->aspectRatio();
                                                        })->stream();
            Storage::disk('public')->put('blog/'.$cimagename,$resize_image);

        } else {
            $cimagename = $blog->cover_photo;
        }

        $blog->title = $request->title;
        $blog->slug = $request->slug;
        $blog->short_description = $request->short_description;
        $blog->description = $request->description;
        $blog->cover_photo = $cimagename;
        $blog->save();

        Toastr::success('Blog successfully update.' ,'Success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        //
    }
}
