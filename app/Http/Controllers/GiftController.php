<?php

namespace App\Http\Controllers;

use App\Order;
use App\Billingaddress;
use App\Shipping_address;
use Brian2694\Toastr\Facades\Toastr;
use App\Library\SslCommerz\SslCommerzNotification;
use Illuminate\Http\Request;

class GiftController extends Controller
{
    public function gift()
    {
    	$title = 'Gift';
    	return view('gift',compact('title'));
    }

    public function gift_store(Request $request)
    {
        $this->validate($request,[
            'billing_name' => 'required|max:100',
            'billing_phone' => 'required|max:50',
            'billing_email' => 'required|max:100',
            'billing_address' => 'required|max:2000',

            'shipping_name' => 'required|max:100',
            'shipping_phone' => 'required|max:50',
            'shipping_email' => 'required|max:100',
            'shipping_address' => 'required|max:2000',

            'product_id' => 'required',
            'quantity' => 'required',
            'subtotal' => 'required',
            'payment_method' => 'required',
            'shipping_charge' => 'required|numeric',
        ]);        

        if ($request->product_id) {
          $product_id =trim(implode(",",$request->product_id),",");
        } else {
         $product_id = null;
        }

        if ($request->quantity) {
          $quantity =trim(implode(",",$request->quantity),",");
        } else {
         $quantity = null;
        }

        $last_ac = Order::select('id')->latest()->first();

        if (isset($last_ac)) {
            $order_code = 'O-'.sprintf('%04d',$last_ac->id+1);
        }else {
            $order_code = 'O-'.sprintf('%04d',1);
        }

        if ($request->waraper) {
            $waraper = $request->waraper;
            $total = $request->subtotal + $request->shipping_charge +$waraper;
        }else {
            $waraper = 0;
            $total = $request->subtotal + $request->shipping_charge +$waraper;
        }

        // for sslcommerz
        $post_data = array();
        $post_data['total_amount'] = $total; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $request->billing_name;
        $post_data['cus_email'] = $request->billing_email;
        $post_data['cus_add1'] = $request->billing_address;
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = $request->billing_phone;
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = $request->shipping_name;
        $post_data['ship_add1'] = $request->shipping_address;
        $post_data['ship_add2'] = "";
        $post_data['ship_city'] = "";
        $post_data['ship_state'] = "";
        $post_data['ship_postcode'] = "";
        $post_data['ship_phone'] = $request->shipping_phone;
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = $order_code;
        $post_data['product_category'] = "Books";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";
        // sslcommerz end

        $order = new Order();
        $order->order_code = $order_code;
        $order->product_id = $product_id;
        $order->quantity = $quantity;
        $order->subtotal = $request->subtotal;
        $order->shipping_charge = $request->shipping_charge;
        $order->waraper = $waraper;
        $order->total = $total;
        $order->payment_method = $request->payment_method;
        $order->transaction_id = $post_data['tran_id'];
        $order->order_type = 'gift';
        $order->save();

        // for billing address
        $billingaddress = new Billingaddress();
        $billingaddress->order_code = $order_code;
        $billingaddress->name = $request->billing_name;
        $billingaddress->phone = $request->billing_phone;
        $billingaddress->email = $request->billing_email;
        $billingaddress->address = $request->billing_address;
        $billingaddress->save();

        // for Shipping address
        $shipping_address = new Shipping_address();
        $shipping_address->order_code = $order_code;
        $shipping_address->name = $request->shipping_name;
        $shipping_address->phone = $request->shipping_phone;
        $shipping_address->email = $request->shipping_email;
        $shipping_address->address = $request->shipping_address;
        $shipping_address->save();

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }
                
    }
}
