<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::latest()->paginate(20);
        $title = 'Brand';
        return view('admin.brand',compact('brands','title'));
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
            'name' => 'required|max:100',
            'eng' => 'nullable|max:200',
            'slug' => 'required|unique:subjects|max:100',
            'image' => 'nullable|mimes:jpeg,webp,gif,png,jpg',
        ]);

        // get form image
        $image = $request->file('image');
        $slug = $request->slug;
        if (isset($image))
        {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            //check brand dir is exists
            if (!Storage::disk('public')->exists('brand'))
            {
                Storage::disk('public')->makeDirectory('brand');
            }
            // resize image for brand and upload
            $resize_image = Image::make($image)->resize(190,88,function ($constraint) {
                                                            $constraint->aspectRatio();
                                                        })->stream();
            Storage::disk('public')->put('brand/'.$imagename,$resize_image);

        } else {
            $imagename = "default.png";
        }


        $brand = new Brand();
        $brand->name = $request->name;
        $brand->eng = $request->eng;
        $brand->slug = $request->slug;
        if ($request->feature) {
            $brand->feature = $request->feature;
        }else {
            $brand->feature = 0;
        }
        
        $brand->image = $imagename;
        $brand->save();

        Toastr::success('Brand successfully saved.' ,'Success');
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        $this->validate($request,[
            'name' => 'required|max:100',
            'eng' => 'nullable|max:200',
            'slug' => 'required|unique:subjects|max:100',
            'image' => 'nullable|mimes:jpeg,webp,gif,png,jpg',
        ]);

        // get form image
        $image = $request->file('image');
        $slug = $request->slug;
        if (isset($image))
        {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            //check brand dir is exists
            if (!Storage::disk('public')->exists('brand'))
            {
                Storage::disk('public')->makeDirectory('brand');
            }

            //delete old image
            if (Storage::disk('public')->exists('brand/'.$brand->image))
            {
               Storage::disk('public')->delete('brand/'.$brand->image);
            }

            // resize image for brand and upload
            $resize_image = Image::make($image)->resize(190,88,function ($constraint) {
                                                            $constraint->aspectRatio();
                                                        })->stream();
            Storage::disk('public')->put('brand/'.$imagename,$resize_image);

        } else {
            $imagename = $brand->image;
        }


        $brand->name = $request->name;
        $brand->eng = $request->eng;
        $brand->slug = $request->slug;
        if ($request->feature) {
            $brand->feature = $request->feature;
        }else {
            $brand->feature = 0;
        }
        
        $brand->image = $imagename;
        $brand->save();

        Toastr::success('Brand successfully update.' ,'Success');
        return redirect()->back();
    }

}
