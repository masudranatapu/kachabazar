<?php

namespace App\Http\Controllers\Customer;

use App\User;
use Auth;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InformationController extends Controller
{
    // for coustomer information
	public function information()
	{
    	if (session()->get('checkout')) {
    		session()->forget('checkout');
    		return redirect()->route('customer.checkout.index');
    	}else {
			// for header
			$title = 'User Info';

			return view('customer.information',compact('title'));
    	}

	}

	// for update profile
    public function updateProfile(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);

        $user = User::findOrFail(Auth::id());

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->save();
        
        Toastr::success('Profile update successfully.','Success');
        return redirect()->back();
    }

	// for coustomer password update
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
