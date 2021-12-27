<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Payment;
use Brian2694\Toastr\Facades\Toastr;


class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::latest()->get();
        return view('admin.payment.index', compact('payments'));
    }
    
    public function store(Request $request)
    {
        //
        Payment::insert([
            'name' => $request->name,
            'phone' => $request->phone,
            'status' => $request->status,
        ]);
        Toastr::success('Payment Getway  Successfully Save :)' ,'Success');
        return redirect()->back();

    }
    
    public function update(Request $request, $id)
    {
        //
        Payment::findOrFail($id)->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'status' => $request->status,
        ]);
        Toastr::success('Payment Getway  Successfully Updated :)' ,'Success');
        return redirect()->back();
    }
    
    public function destroy($id)
    {
        //
        Payment::findOrFail($id)->delete();
        Toastr::warning('Payment Getway  Successfully deleted :)' ,'Warning');
        return redirect()->back();
    }
    public function paymentActive($id)
    {
        
        Payment::findOrFail($id)->update(['status' => 1]);

        Toastr::success('Payment Getway successfully active :)' ,'Success');
        return redirect()->back();
    }
    public function paymentInActive($id)
    {
        
        Payment::findOrFail($id)->update(['status' => 0]);
        
        Toastr::info('Payment Getway successfully inactive :)' ,'info');
        return redirect()->back();
    }
}
