@extends('layouts.frontend.app')

@section('title')
    {{$title}}
@endsection


@section('meta')

@endsection

@push('css')
    <style>
        .panel_bg {
            background-color: #0D7E40;
            color: white;
        }
    </style>
@endpush

@section('content')
<!--breadcrumbs area start-->
<div class="breadcrumbs_area commun_bread py-3 grey-section">
    <div class="container">   
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <ul class="text-capitalize">
                        <li><a href="{{ route('home') }}">home</a></li>
                        <li><i class="fa fa-angle-right"></i></li>
                        <li>Order Checkout</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>         
</div>
<!--breadcrumbs area end-->
<section class="pad-tb-25 mt-10">
    <div class="container">
        <div class="row">

            <div class="col-md-3 eng">
                {{-- for coustomer_sidebar --}}
                @include('layouts.frontend.partial.coustomer_sidebar')
            </div>
            <div class="col-md-9">
                <div class="alert panel_bg">
                    <strong>
                        Order List
                    </strong>
                </div>
                <div class="row">
                    <div class="col-md-12 table-responsive">
                        <table class="table table-bordered" style="font-size:14px;background-color:#FFF;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Order ID</th>
                                    <th>Order Date</th>
                                    <th>Total</th>
                                    <th>Pyment Method</th>
                                    <th>Pyment Status</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $key=>$order)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $order->order_code }}</td>
                                        <td>{{ $order->created_at->format('d M Y h:i A') }}</td>
                                        <td><strong>{{ $order->total }}<sup>৳</sup></strong></td>
                                        <td>{{ $order->payment_method }}</td>
                                        <td>
                                            @if($order->order_status == 'Delivered' || $order->order_status == 'Successed')
                                                <span class="badge" style="background: green; color: white;">Payment Success</span>
                                            @elseif($order->order_status == 'Processing')
                                                <span class="badge bg-info" style="color: white;">Payment Processing</span>
                                            @elseif($order->order_status == 'Canceled')
                                                <span class="badge" style="background: red; color: white;">Payment Cancel</span>
                                            @else
                                                <span class="badge bg-warning" style="color: white;">Payment Pending</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($order->order_status == 'Delivered' || $order->order_status == 'Successed')
                                                <span class="badge" style="background: green; color: white;">Order Success</span>
                                            @elseif($order->order_status == 'Confirmed')
                                                <span class="badge bg-info" style="color: white;">Order Confirmed</span>
                                            @elseif($order->order_status == 'Processing')
                                                <span class="badge bg-info" style="color: white;">Order Processing</span>
                                            @elseif($order->order_status == 'Canceled')
                                                <span class="badge" style="background: red; color: white;">Order Canceled</span>
                                            @else
                                                <span class="badge bg-info" style="color: white;">Order Pending</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($order->order_status == 'Pending')
                                                <a href="{{ route('customer.order_cancel',$order->id) }}" onclick="return confirm('Are you sure to cancel order?')" class="cencel_btn btn btn-danger btn-xs waves-effect">
                                                    Cancel Order
                                                </a>
                                            @endif

                                            @if ($order->order_status == 'Delivered')
                                                <a href="{{ route('customer.order_success',$order->id) }}" class="cencel_btn btn btn-success btn-xs waves-effect">
                                                    Success Order
                                                </a>
                                            @endif
                                            <a href="{{ route('customer.order_view',$order->id) }}" class="cencel_btn btn btn-info btn-xs" > View details </a>
                                        </td>


                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$orders->onEachSide(2)->links()}}
                    </div>

                </div>


            </div>

        </div>
    </div>
</section>

@endsection

@push('js')


@endpush
