<?php

namespace App\Http\Controllers\Admin;

use App\Size;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $size = Size::latest()->get();
        return view('admin.size.index',compact('size'));
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
            'name' => 'required',
            'status' => 'required',
        ]);

        $slug = str_slug($request->name);

        $size = new Size();
        $size->name = $request->name;
        $size->slug = $slug;
        $size->status = $request->status;
        $size->save();

        Toastr::success('Size Successfully Save :)' ,'Success');
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Size $size)
    {
        $this->validate($request,[
            'name' => 'required',
            'status' => 'required',
        ]);

        $slug = str_slug($request->name);

        $size->name = $request->name;
        $size->slug = $slug;
        $size->status = $request->status;
        $size->save();

        Toastr::success('Size Successfully Update :)' ,'Success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function destroy(Size $size)
    {
        $size->delete();

        Toastr::success('Size Successfully Deleted :)','Success');
        return redirect()->back();
    }
}
