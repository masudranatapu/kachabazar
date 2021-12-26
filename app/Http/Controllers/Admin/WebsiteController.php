<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Website;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $website = Website::latest()->first();

        return view('admin.website.edit', compact('website'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Website $website)
    {
        return view('admin.website.edit', compact('website'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Website $website)
    {
        $this->validate($request, [
            'title' => 'required',
            'email' => 'required',
            'address' => 'required',
            'phone' => 'required',
        ]);

        // get form favicon
        $favicon = $request->file('favicon');
        $slug = 'favicon';
        if (isset($favicon)) {
            //make unique name for favicon
            $currentDate = Carbon::now()->toDateString();
            $fav_icon = $slug.'-'.$currentDate.'-'.uniqid().'.'.$favicon->getClientOriginalExtension();
            $upload_path = 'assets/backend/img/fav_icon/';
            $fav_icon_url = $upload_path.$fav_icon;
            if ($website->favicon) {
                unlink($website->favicon);
            }
            $favicon->move($upload_path, $fav_icon);
        } else {
            $fav_icon_url = $website->favicon;
        }

        // for logo
        $logo = $request->file('logo');
        $slug_1 = 'logo';
        if (isset($logo)) {
            // make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $logo_image = $slug_1.'-'.$currentDate.'-'.uniqid().'.'.$logo->getClientOriginalExtension();
            $upload_path = 'assets/backend/img/logo/';
            $logo_image_url = $upload_path.$logo_image;
            if ($website->favicon) {
                unlink($website->favicon);
            }
            $logo->move($upload_path, $logo_image);
        } else {
            $logo_image_url = $website->logo;
        }

        $icon = trim(implode('|', $request->icon), '|');
        $link = trim(implode('|', $request->link), '|');

        $website->title = $request->title;
        $website->description = $request->description;
        $website->meta_keyword = $request->meta_keyword;
        $website->meta_tag = $request->meta_tag;
        $website->email = $request->email;
        $website->address = $request->address;
        $website->phone = $request->phone;
        $website->favicon = $fav_icon_url;
        $website->logo = $logo_image_url;
        $website->twitter_api = $request->twitter_api;
        $website->google_map = $request->google_map;
        $website->icon = $icon;
        $website->link = $link;
        $website->save();

        Toastr::success('Website Information Successfully Update!', 'Success');

        return redirect()->back();
    }
}
