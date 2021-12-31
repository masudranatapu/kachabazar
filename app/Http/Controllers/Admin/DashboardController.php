<?php

namespace App\Http\Controllers\admin;

use App\Product;
use App\Order;
use App\Contact_us;
use App\Subject;
use App\Author;
use App\Publisher;
use App\District;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
    	$products = Product::latest()->get();
    	$order_pending =Order::where('order_status','Pending')->count();
    	$order_Confirmed =Order::where('order_status','Confirmed')->count();
    	$order_Processing =Order::where('order_status','Processing')->count();
    	$order_Delivered =Order::where('order_status','Delivered')->count();
    	$order_Successed =Order::where('order_status','Successed')->count();
    	$order_Canceled =Order::where('order_status','Canceled')->count();
    	$allorder =Order::count();
		$messeges = Contact_us::count();
		$districts = District::latest()->get();

    	return view('admin.dashboard',compact('districts', 'products','order_pending','order_Confirmed','order_Processing','order_Delivered','order_Successed','order_Canceled','allorder','messeges'));
    }
	public function orderSearch(Request $request)
	{
		return $request;
		
    	$products = Product::latest()->get();
		$districts = District::latest()->get();

		return view('admin.search', compact('title', 'products', 'districts'));
	}
}
