<?php

namespace App\Http\Controllers\Customer;

use App\Wishlist;
use App\Review;
use Auth;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // for header
        $title = 'Wishlist';
        $wishlists = Wishlist::where('user_id',Auth::id())->latest()->paginate(10);

        return view('customer.wishlist',compact('title','wishlists'));
    }

    public function review(Request $request)
    {
        $this->validate($request,[
            'opinion' => 'nullable|max:1000',
        ]);

        $review = new Review();
        $review->product_id = $request->product_id;
        $review->opinion = $request->opinion;
        $review->rating = $request->rating;
        if(Auth::user()) {
            $review->user_id = Auth::id();
        }else {
            $review->user_id = "001";
        }
        $review->save();

        Toastr::success('Review successfully complete.' ,'Success');
        return redirect()->back();
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
            'product_id' => 'required',
        ]);

        $product = Wishlist::where('user_id',Auth::id())->where('product_id',$request->product_id)->first();

        if ($product) {
            Toastr::error('This item already added to wishlist!' ,'Error');
            return redirect()->back();
        } else {
            $wishlist = new Wishlist();
            $wishlist->product_id = $request->product_id;
            $wishlist->user_id = Auth::id();
            $wishlist->save();

            Toastr::success('This item successfully added to wishlist!' ,'Success');
            return redirect()->back();
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wishlist $wishlist)
    {
        if ($wishlist->user_id==Auth::id()) {
            $wishlist->delete();

            Toastr::success('Wishlist Successfully Deleted!','Success');
            return redirect()->back();
        } else {
           Toastr::error('You are not parmited to delete this!' ,'Error');
           return redirect()->back();
        }
    }
}
