<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use Brian2694\Toastr\Facades\Toastr;

class SslCommerzPaymentController extends Controller
{

    public function pay(Request $request)
    {
        
        $post_data = array();
        $post_data['total_amount'] = $request->total; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = $request->transaction_id; // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $request->name;
        $post_data['cus_email'] = $request->email;
        $post_data['cus_add1'] = 'Customer Address';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = $request->phone;
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "No";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";

        $update_post = DB::table('orders')
            ->where('transaction_id', $post_data['tran_id'])
            ->update([
                'status' => 'Pending'
            ]);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    public function success(Request $request)
    {
        session()->forget('cart');
        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
        $order_detials = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('id','transaction_id','payment_method','status','order_type')->first();

        if ($order_detials->status == 'Pending') {
            $validation = $sslc->orderValidate($tran_id, $amount, $currency, $request->all());

            if ($validation == TRUE) {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */
                $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update([
                        'payment_method' => $request->input('card_issuer'),
                        'status' => 'Paid'
                    ]);
                    
                    Toastr::success('Transaction successfully Completed.' ,'Success');
                    if ($order_detials->order_type == 'gift') {
                        return redirect()->route('home');
                    }else {
                        return redirect()->route('customer.my_order');
                    }
                    
            } else {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel and Transation validation failed.
                Here you need to update order status as Failed in order table.
                */
                $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Failed']);

                Toastr::error('Validation Failed.' ,'Sorry');
                if ($order_detials->order_type == 'gift') {
                    return redirect()->route('home');
                }else {
                    return redirect()->route('customer.my_order');
                }
            }
        } else if ($order_detials->status == 'Paid' || $order_detials->status == 'Complete') {
            /*
             That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
             */
            Toastr::success('Transaction is successfully Completed.' ,'Success');
            if ($order_detials->order_type == 'gift') {
                return redirect()->route('home');
            }else {
                return redirect()->route('customer.my_order');
            }
        } else {
            #That means something wrong happened. You can redirect customer to your product page.
            Toastr::error('Invalid Transaction' ,'Error');
            if ($order_detials->order_type == 'gift') {
                return redirect()->route('home');
            }else {
                return redirect()->route('customer.my_order');
            }
        }


    }

    public function fail(Request $request)
    {
        session()->forget('cart');
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'total','order_type')->first();

        if ($order_detials->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Failed']);
            Toastr::error('Transaction is Falied' ,'Error');
            if ($order_detials->order_type == 'gift') {
                return redirect()->route('home');
            }else {
                return redirect()->route('customer.my_order');
            }
        } else if ($order_detials->status == 'Paid' || $order_detials->status == 'Complete') {
            Toastr::success('Transaction is already Successfull' ,'Success');
            if ($order_detials->order_type == 'gift') {
                return redirect()->route('home');
            }else {
                return redirect()->route('customer.my_order');
            }
        } else {
            Toastr::error('Transaction is Invalid' ,'Error');
            if ($order_detials->order_type == 'gift') {
                return redirect()->route('home');
            }else {
                return redirect()->route('customer.my_order');
            }
        }

    }

    public function cancel(Request $request)
    {
        session()->forget('cart');
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'total','order_type')->first();

        if ($order_detials->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled']);

            Toastr::error('Transaction is Canceled' ,'Error');
            if ($order_detials->order_type == 'gift') {
                return redirect()->route('home');
            }else {
                return redirect()->route('customer.my_order');
            }
        } else if ($order_detials->status == 'Paid' || $order_detials->status == 'Complete') {
            Toastr::success('Transaction is already Successfull' ,'Success');
            if ($order_detials->order_type == 'gift') {
                return redirect()->route('home');
            }else {
                return redirect()->route('customer.my_order');
            }
        } else {
            Toastr::error('Transaction is Invalid' ,'Error');
            if ($order_detials->order_type == 'gift') {
                return redirect()->route('home');
            }else {
                return redirect()->route('customer.my_order');
            }
        }


    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');
            $currency = $request->input('currency');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'payment_method', 'total','order_type')->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($tran_id, $order_details->total, $currency, $request->all());
                return $validation;

            } else if ($order_details->status == 'Paid' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                Toastr::success('Transaction is successfully Completed.' ,'Success');
                if ($order_detials->order_type == 'gift') {
                    return redirect()->route('home');
                }else {
                    return redirect()->route('customer.my_order');
                }
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                Toastr::error('Invalid Transaction' ,'Error');
                if ($order_detials->order_type == 'gift') {
                    return redirect()->route('home');
                }else {
                    return redirect()->route('customer.my_order');
                }
            }
        } else {
            echo "Invalid Data";
        }
    }

}
