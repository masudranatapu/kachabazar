<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services;
use Intervention\Image\Facades\Image;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $services = Services::latest()->get();
        return view('admin.services.index', compact('services'));
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
        //
        $this->validate($request, [
            'title' => 'required|max:100',
            'image' => 'nullable|mimes:jpeg,webp,gif,png,jpg',
            'details' => 'required',
            'status' => 'required',
        ]);
        $services_image = $request->file('image');
        $services_image_name = hexdec(uniqid()).'.'.$services_image->getClientOriginalName();
        Image::make($services_image)->resize(800, 600)->save('assets/services/'.$services_image_name);
        $services_image_url = 'assets/services/'.$services_image_name;
        
        Services::insert([
            'title' => $request->title,
            'slug' => strtolower(str_replace(' ', '-', $request->title)),
            'details' => $request->details,
            'status' => $request->status,
            'image' => $services_image_url,
            'created_at' => Carbon::now(),
        ]);
        Toastr::success('Services Successfully Save :)','Success');
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'title' => 'required|max:100',
            'image' => 'nullable|mimes:jpeg,webp,gif,png,jpg',
            'details' => 'required',
            'status' => 'required',
        ]);

        $old_image = $request->old_image;

        if($request->file('image')) {

            if(file_exists($old_image)) {
                unlink($old_image);
            }

            $services_image = $request->file('image');
            $services_image_name = hexdec(uniqid()).'.'.$services_image->getClientOriginalName();
            Image::make($services_image)->resize(800, 600)->save('assets/services/'.$services_image_name);
            $services_image_url = 'assets/services/'.$services_image_name;

            Services::find($id)->update([
                'title' => $request->title,
                'slug' => strtolower(str_replace(' ', '-', $request->title)),
                'details' => $request->details,
                'status' => $request->status,
                'image' => $services_image_url,
                'updated_at' => Carbon::now(),
            ]);
            Toastr::success('Services Successfully updated :)','Success');
            return redirect()->back();
        }else {
            Services::find($id)->update([
                'title' => $request->title,
                'slug' => strtolower(str_replace(' ', '-', $request->title)),
                'details' => $request->details,
                'status' => $request->status,
                'updated_at' => Carbon::now(),
            ]);
            Toastr::success('Services Successfully updated :)','Success');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $image = Services::findOrFail($id);
        
        $image_delete = $image->image;
        if(file_exists($image_delete)) {
            unlink($image_delete);
        }
        
        Services::findOrFail($id)->delete();
        Toastr::warning('Services Successfully deleted :)','Success');
        return redirect()->back();

    }

    public function Active($id)
    {
        Services::findOrFail($id)->update(['status'=> 1]);
        Toastr::success('Services Successfully Active :)','Success');
        return redirect()->back();
    }

    public function InActive($id)
    {
        Services::findOrFail($id)->update(['status'=> 0]);
        Toastr::success('Services Successfully Inactive :)','Success');
        return redirect()->back();
    }
}
