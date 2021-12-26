<?php

namespace App\Http\Controllers\Admin;

use App\Contact_us;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // for header
        $title = 'Message';
        $messeges = Contact_us::latest()->paginate(100);

        return view('admin.message.index',compact('title','messeges'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact_us  $contact_us
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Contact_us::find($id)->delete();

        Toastr::success('Message Successfully Deleted!' ,'Success');
        return redirect()->back();
    }
}
