<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Slider;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slider = Slider::latest()->get();

        return view('admin.slider.index', compact('slider'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'link' => 'required',
            'image' => 'required',
        ]);

        // get form image
        $image = $request->file('image');
        $slug = 'slider';
        if (isset($image)) {
            // path
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            $upload_path = 'assets/backend/img/slider/';
            $image_url = $upload_path.$imagename;
            $image->move($upload_path, $imagename);
        } else {
            $image_url = 'default.png';
        }

        $slider = new Slider();
        $slider->link = $request->link;
        $slider->image = $image_url;
        $slider->save();

        Toastr::success('Slider Successfully Save :)', 'Success');

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        $this->validate($request, [
            'link' => 'required',
        ]);

        // get form image
        $image = $request->file('image');
        $slug = 'slider';
        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            $upload_path = 'assets/backend/img/slider/';
            $image_url = $upload_path.$imagename;
            if ($slider->image) {
                unlink($slider->image);
            }
            $image->move($upload_path, $imagename);
        } else {
            $image_url = $slider->image;
        }

        $slider->link = $request->link;
        $slider->image = $image_url;
        $slider->save();

        Toastr::success('Slider Successfully Update !', 'Success');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        // delete old image
        if ($slider->image) {
            unlink($slider->image);
        }

        $slider->delete();

        Toastr::success('Slider Successfully Delete :)', 'Success');

        return redirect()->back();
    }
}
