<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class SettingsController extends Controller
{
    public function index()
    {
        return view('admin.settings');
    }

    public function updateProfile(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
        ]);
        $image = $request->file('image');
        $slug = str_slug($request->name);
        $user = User::findOrFail(Auth::id());

        if (isset($image))
        {
                // make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
//            check profile dir is exists
            if (!Storage::disk('public')->exists('profile'))
            {
                Storage::disk('public')->makeDirectory('profile');
            }
//            delete old image
            if (Storage::disk('public')->exists('profile/'.$user->image))
            {
                Storage::disk('public')->delete('profile/'.$user->image);
            }
//            resize image for profile and upload
            $categoryimage = Image::make($image)->resize(413,413)->stream();
            Storage::disk('public')->put('profile/'.$imagename,$categoryimage);


        } else {
            $imagename = $user->image;
        }

        $user->name = $request->name;
        $user->image = $imagename;
        $user->save();
        Toastr::success('Profile Successfully Updated :)','Success');
        return redirect()->back();
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request,[
            'old_password' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->old_password,$hashedPassword))
        {
            if (!Hash::check($request->password,$hashedPassword))
            {
                $user = User::find(Auth::id());
                $user->password = Hash::make($request->password);
                $user->save();
                Toastr::success('Password Successfully Changed','Success');
                Auth::logout();
                return redirect()->back();
            } else {
                Toastr::error('New password cannot be the same as old password.','Error');
                return redirect()->back();
            }
        } else {
            Toastr::error('Current password not match.','Error');
            return redirect()->back();
        }

    }
}
