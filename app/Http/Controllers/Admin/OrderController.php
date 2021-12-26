<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use App\Billingaddress;
use App\Shipping_address;
use App\Sold;
use App\Product;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
	// for all_order
    public function all_order()
    {
    	// for header
    	$title = 'Order';
    	$orders = Order::latest()->paginate(20);

    	return view('admin.order.all_order',compact('title','orders'));
    }

    // for pending_order
    public function pending_order()
    {
    	// for header
    	$title = 'Pending order';
    	$orders = Order::where('order_status','Pending')->latest()->paginate(20);

    	return view('admin.order.all_order',compact('title','orders'));
    }

    // for confirmed_order
    public function confirmed_order()
    {
    	// for header
    	$title = 'Confirmed order';
    	$orders = Order::where('order_status','Confirmed')->latest()->paginate(20);

    	return view('admin.order.all_order',compact('title','orders'));
    }

    // for processing_order
    public function processing_order()
    {
    	// for header
    	$title = 'Processing order';
    	$orders = Order::where('order_status','Processing')->latest()->paginate(20);

    	return view('admin.order.all_order',compact('title','orders'));
    }

    // for delivered_order
    public function delivered_order()
    {
    	// for header
    	$title = 'Delivered order';
    	$orders = Order::where('order_status','Delivered')->latest()->paginate(20);

    	return view('admin.order.all_order',compact('title','orders'));
    }

    // for successed_order
    public function successed_order()
    {
    	// for header
    	$title = 'Successed order';
    	$orders = Order::where('order_status','Successed')->latest()->paginate(20);

    	return view('admin.order.all_order',compact('title','orders'));
    }

    // for canceled_order
    public function canceled_order()
    {
    	// for header
    	$title = 'Canceled order';
    	$orders = Order::where('order_status','Canceled')->latest()->paginate(20);

    	return view('admin.order.all_order',compact('title','orders'));
    }

    public function order_view($order_id)
    {
    	// for header
    	$title = 'Order details';
    	$order = Order::find($order_id);

    	$shipping_address =Shipping_address::where('order_code',$order->order_code)->first();
    	$billingaddress =Billingaddress::where('order_code',$order->order_code)->first();

    	return view('admin.order.order_details',compact('title','order','shipping_address','billingaddress'));
    }

    // for order_status_change
    public function order_status_change(Request $request)
    {
        $order = Order::find($request->order_id);
        if ($request->order_status=='Successed') {
            $order->status = "Paid";
        }
        $order->order_status = $request->order_status;
        $order->save();

        if ($request->order_status=='Confirmed') {
            $sold = Sold::where('order_code',$order->order_code)->first();
            if (!$sold) {
                $product_id = explode(",",$order->product_id);
                $quantity = explode(",",$order->quantity);

                foreach ($product_id as $key => $id) {
                    $product = Product::find($id);

                    $sold = new Sold();
                    $sold->order_code = $order->order_code;
                    $sold->product_id = $product->id;
                    $sold->title = $product->title;
                    $sold->eng = $product->eng;
                    $sold->product_code = $product->product_code;
                    $sold->quantity = $quantity[$key];
                    $sold->save();
                }
                
            }
        }

        Toastr::success('Order Successfully '.$request->order_status.' !','Success');
        return redirect()->back();
    }

}
