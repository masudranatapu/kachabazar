<?php

namespace App\Http\Controllers\Admin;

use App\District;
use App\Division;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'District';
        $districts =District::latest()->paginate(12);
        $cr_division =Division::all();
        $ed_division =Division::all();
        $src_division =Division::all();
        $search =null;
        return view('admin.district',compact('districts','title','cr_division','ed_division'
            ,'src_division','search'));
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
            'name' => 'required|unique:districts',
            'division_id' => 'required',
        ]);

        $slug = str_slug($request->name);

        $district = new District();
        $district->division_id = $request->division_id;
        $district->name = $request->name;
        $district->slug = $slug;
        $district->save();

        Toastr::success('District Create successfully.' ,'Success');
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\District  $district
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, District $district)
    {
        $this->validate($request,[
            'name' => 'required',
            'division_id' => 'required',
        ]);

        $slug = str_slug($request->name);

        $district->division_id = $request->division_id;
        $district->name = $request->name;
        $district->slug = $slug;
        $district->save();

        Toastr::success('District updated successfully.' ,'Success');
        return redirect()->back();
    }

}
