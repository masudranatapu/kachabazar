<?php

namespace App\Http\Controllers\Admin;

use App\Policy;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $policys = Policy::latest()->paginate(20);
        $title = 'Policy';
        return view('admin.policy',compact('policys','title'));
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
            'slug' => 'required|unique:policies|max:100',
            'description' => 'required',
        ]);

        $policy = new Policy();
        $policy->name = $request->name;
        $policy->slug = $request->slug;
        $policy->description = $request->description;
        $policy->save();

        Toastr::success('Policy successfully saved.' ,'Success');
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function edit(Policy $policy)
    {
        return view('admin.policy_update',compact('policy'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Policy $policy)
    {
        $this->validate($request,[
            'name' => 'required|max:100',
            'slug' => 'required|max:100',
            'description' => 'required',
        ]);

        $policy->name = $request->name;
        $policy->slug = $request->slug;
        $policy->description = $request->description;
        $policy->save();

        Toastr::success('Policy successfully update.' ,'Success');
        return redirect()->back();
    }
}
