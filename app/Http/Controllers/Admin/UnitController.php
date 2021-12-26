<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Unit;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unit = Unit::latest()->get();

        return view('admin.unit.index', compact('unit'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'status' => 'required',
        ]);

        $slug = str_slug($request->name);

        $unit = new Unit();
        $unit->name = $request->name;
        $unit->slug = $slug;
        $unit->status = $request->status;
        $unit->save();

        Toastr::success('Unit Successfully Save :)', 'Success');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unit $unit)
    {
        $this->validate($request, [
            'name' => 'required',
            'status' => 'required',
        ]);

        $slug = str_slug($request->name);

        $unit->name = $request->name;
        $unit->slug = $slug;
        $unit->status = $request->status;
        $unit->save();

        Toastr::success('Unit Successfully Update :)', 'Success');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
