<?php

namespace App\Http\Controllers\Admin;

use App\Division;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $divisions = Division::latest()->paginate(15);
        return view('admin.division',compact('divisions'));
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
            'name' => 'required|unique:divisions',
        ]);

        $slug = str_slug($request->name);

        $division = new Division();
        $division->name = $request->name;
        $division->slug = $slug;
        $division->save();

        Toastr::success('Division Create successfully.' ,'Success');
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Division $division)
    {
        $this->validate($request,[
            'name' => 'required',
        ]);

        $slug = str_slug($request->name);

        $division->name = $request->name;
        $division->slug = $slug;
        $division->save();

        Toastr::success('Division Create successfully.' ,'Success');
        return redirect()->back();
    }

}
