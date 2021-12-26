<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorys = Category::orderBy('order', 'desc')->paginate(20);
        $parents = Category::Where('parent_id', null)->select('id', 'name')->get();
        $title = 'Category';
        $search = null;

        return view('admin.category', compact('categorys', 'parents', 'title', 'search'));
    }

    public function category_search(Request $request)
    {
        $search = $request->search;

        $query = Category::query();
        if (isset($search)) {
            $query = $query->orWhere('name', 'LIKE', '%'.$search.'%');
            $query = $query->orWhere('eng', 'LIKE', '%'.$search.'%');
        }

        $query = $query->latest()->paginate(20);
        $query->withPath('?search='.$search);

        $subjects = $query;
        $title = 'Category';

        $parents = Category::where('parent_id', null)->select('id', 'name')->get();

        return view('admin.category', compact('categorys', 'parents', 'title', 'search'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:100',
            'eng' => 'nullable|max:200',
            'slug' => 'required|unique:categories|max:100',
            'order' => 'required|numeric',
            'image' => 'nullable|mimes:jpeg,webp,gif,png,jpg',
        ]);

        // get form image
        $image = $request->file('image');
        $slug = $request->slug;
        if (isset($image)) {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            $upload_path = 'assets/backend/img/category/';
            $image_url = $upload_path.$imagename;
            $image->move($upload_path, $imagename);
        } else {
            $image_url = 'default.png';
        }

        $category = new Category();
        $category->parent_id = $request->parent_id;
        $category->name = $request->name;
        $category->eng = $request->eng;
        $category->slug = $request->slug;
        $category->order = $request->order;
        if ($request->menu) {
            $category->menu = $request->menu;
        } else {
            $category->menu = 0;
        }

        if ($request->feature) {
            $category->feature = $request->feature;
        } else {
            $category->feature = 0;
        }

        if ($request->home) {
            $category->home = $request->home;
        } else {
            $category->home = 0;
        }

        $category->image = $image_url;
        $category->save();

        Toastr::success('Category successfully saved.', 'Success');

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'name' => 'required|max:100',
            'eng' => 'nullable|max:200',
            'slug' => 'required|max:100',
            'order' => 'required|numeric',
            'image' => 'nullable|mimes:jpeg,webp,gif,png,jpg',
        ]);

        // get form image
        $image = $request->file('image');
        $slug = $request->slug;
        if (isset($image)) {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            //check category dir is exists
            // if (!Storage::disk('public')->exists('category')) {
            //     Storage::disk('public')->makeDirectory('category');
            // }

            //delete old image
            // if (Storage::disk('public')->exists('category/'.$category->image)) {
            //     Storage::disk('public')->delete('category/'.$category->image);
            // }

            // resize image for category and upload
            // $resize_image = Image::make($image)->resize(100, 100, function ($constraint) {
            //     $constraint->aspectRatio();
            // })->stream();

            if ($category->image) {
                if(file_exists($category->image)){
                    unlink($category->image);
                }
            }
            $upload_path = 'assets/backend/img/category/';
            $image_url = $upload_path.$imagename;
            $image->move($upload_path, $imagename);
        } else {
            $image_url = $category->image;
        }

        $category->parent_id = $request->parent_id;
        $category->name = $request->name;
        $category->eng = $request->eng;
        $category->slug = $request->slug;
        $category->order = $request->order;
        if ($request->menu) {
            $category->menu = $request->menu;
        } else {
            $category->menu = 0;
        }

        if ($request->feature) {
            $category->feature = $request->feature;
        } else {
            $category->feature = 0;
        }

        if ($request->home) {
            $category->home = $request->home;
        } else {
            $category->home = 0;
        }

        $category->image = $image_url;
        $category->save();

        Toastr::success('Category successfully update.', 'Success');

        return redirect()->back();
    }
}
