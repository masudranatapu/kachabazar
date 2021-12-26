<?php

namespace App\Http\Controllers\admin;

use App\Product;
use App\Order;
use App\Contact_us;
use App\Subject;
use App\Author;
use App\Publisher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
    	$product = Product::latest()->count();
    	$order_pending =Order::where('order_status','Pending')->count();
    	$order_Confirmed =Order::where('order_status','Confirmed')->count();
    	$order_Processing =Order::where('order_status','Processing')->count();
    	$order_Delivered =Order::where('order_status','Delivered')->count();
    	$order_Successed =Order::where('order_status','Successed')->count();
    	$order_Canceled =Order::where('order_status','Canceled')->count();
    	$allorder =Order::count();
		$messeges = Contact_us::count();

    	return view('admin.dashboard',compact('product','order_pending','order_Confirmed','order_Processing','order_Delivered','order_Successed','order_Canceled','allorder','messeges'));
    }
}
