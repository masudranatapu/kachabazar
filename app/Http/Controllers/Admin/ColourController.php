<?php

namespace App\Http\Controllers\Admin;

use App\Colour;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ColourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colour = Colour::latest()->get();
        return view('admin.colour.index',compact('colour'));
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

        $colour = new Colour();
        $colour->name = $request->name;
        $colour->slug = $slug;
        $colour->status = $request->status;
        $colour->save();

        Toastr::success('Colour Successfully Save :)' ,'Success');
        return redirect()->back();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Colour  $colour
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Colour $colour)
    {
        $this->validate($request,[
            'name' => 'required',
            'status' => 'required',
        ]);

        $slug = str_slug($request->name);

        $colour->name = $request->name;
        $colour->slug = $slug;
        $colour->status = $request->status;
        $colour->save();

        Toastr::success('Colour Successfully Update :)' ,'Success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Colour  $colour
     * @return \Illuminate\Http\Response
     */
    public function destroy(Colour $colour)
    {
        $colour->delete();

        Toastr::success('Colour Successfully Deleted :)','Success');
        return redirect()->back();
    }
}
