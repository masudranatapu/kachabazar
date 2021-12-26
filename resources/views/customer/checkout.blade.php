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
    <div class="breadcrumbs_area commun_bread py-3 grey-section">
        <div class="container">   
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul class="text-capitalize">
                            <li><a href="{{ route('home') }}">home</a></li>
                            <li><i class="fa fa-angle-right"></i></li>
                            <li>Checkout</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>         
    </div>
    @auth
        <form action="{{ route('customer.checkout.store') }}" method="POST" >
            @csrf
            <section class="pad-tb-25 mt-20">
                <div class="container">
                    <div class="row" style="font-size:14px;">
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="alert panel_bg">
                                    <strong>
                                        Billing Information
                                    </strong>
                                </div>
                                <div class="panel-body panel_area">
                                    <div class="form-group">
                                        <label>Full Name</label>
                                        <input type="text" class="form-control" name="billing_name" value="{{Auth::user()->name}}" placeholder="Your Name" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="billing_email" value="{{Auth::user()->email}}" placeholder="Your Email">
                                    </div>
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input required type="text" id="phone" class="form-control" placeholder="Phone Number" name="billing_phone" value="{{Auth::user()->phone}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Address</label>
                                        <textarea class="form-control" name="billing_address" placeholder="Your Address" required>{{Auth::user()->address}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="checkbox">
                                {{-- <label><input type="checkbox" name="check_shipping" checked>Ship to this address</label> --}}
                            </div>
                            <div id="" class="panel panel-default">
                                <div class="alert panel_bg">
                                    <strong>
                                        Shipping Information
                                    </strong>
                                </div>
                                <div class="panel-body panel_area">
                                    <div class="form-group">
                                        <label>Full Name</label>
                                        <input type="text" class="form-control" name="shipping_name" value="{{Auth::user()->name}}" placeholder="Your Name" >
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="shipping_email" value="{{Auth::user()->email}}" placeholder="Your Email">
                                    </div>
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" id="phone" class="form-control" placeholder="Phone Number" name="shipping_phone" value="{{Auth::user()->phone}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Address</label>
                                        <textarea class="form-control" name="shipping_address" placeholder="Your Address">
                                            {{Auth::user()->address}}
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="alert panel_bg">
                                    <strong>
                                        Payment Method
                                    </strong>
                                </div>
                                <div class="panel-body panel_area">
                                    <div class="form-group">
                                        <strong>Payment Method</strong>
                                        <span class="pull-right">
                                            <select name="payment_method" class="form-control">
                                                <option value="Cash" selected >Cash On Delivery</option>
                                            </select>
                                        </span>
                                    </div>
                                    <hr style="margin: 30px; padding: 0px;" />
                                    <h5 class="pb-10">
                                        <strong>Shipping</strong>
                                        <span class="pull-right">
                                            <select name="shipping_charge" id="shipping_charge">
                                                <option value="50">Inside Dhake 50 BDT</option>
                                                <option value="120">Outside Dhake 120 BDT</option>
                                            </select>
                                        </span>
                                    </h5>
                                    <hr style="margin: 30px; padding: 0px;" />
                                </div>
                            </div>
                            <div class="panel panel-success ">
                                <div class="alert panel_bg mt-10">
                                    <strong>
                                        Summary
                                    </strong>
                                </div>
                                <div class="panel-body panel_area">
                                    @if (session('cart'))
                                    @php
                                        $total = 0;
                                    @endphp
                                        <h5>{{count(session('cart'))}} Product in cart</h5>

                                        <table class="table table-responsive table-bordered" style="font-size:14px;background-color:#FFF;">
                                            <tbody>
                                            @foreach (session('cart') as $id => $details)
                                            @php
                                                $total += $details['sell_price'] * $details['quantity'];
                                            @endphp
                                                <tr>
                                                <input type="hidden" name="product_id[]" value="{{ $id }}">
                                                <input type="hidden" name="quantity[]" value="{{ $details['quantity'] }}">
                                                <input type="hidden" name="size_id[]" value="@if ($details['size_id'])
                                                    {{ $details['size_id'] }}
                                                @else
                                                no
                                                @endif">
                                                <input type="hidden" name="colour_id[]" value="@if ($details['colour_id'])
                                                    {{ $details['colour_id'] }}
                                                @else
                                                no
                                                @endif">
                                                    <td><img src="{{ URL::to($details['image']) }}" height="75px"></td>
                                                    <td style="font-size:16px;">
                                                        <strong>{{$details['title'] }}</strong>
                                                    </td>
                                                    <td><strong>{{$details['sell_price']}}</strong><sup>৳</sup> x <strong>{{$details['quantity']}}</strong></td>
                                                    <td><strong>{{ $details['sell_price'] * $details['quantity'] }}</strong><sup>৳</sup></td>
                                                </tr>
                                            @endforeach
                                                <tr>
                                                    <input type="hidden" name="subtotal" value="{{ $total }}" id="sub_total">
                                                    <td colspan="3" style="text-align:right;">Subtotal</td>
                                                    <td><strong>{{ $total }}</strong><sup>৳</sup></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" style="text-align:right;">Shipping Charge</td>
                                                    <td><strong><span id="shipping_total">50</span></strong><sup>৳</sup></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" style="text-align:right;">Gift Wrap</td>
                                                    <td><strong><span id="waraper_total">0</span></strong><sup>৳</sup></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" style="text-align:right;"><strong>GRAND TOTAL</strong></td>
                                                    <td><strong><span id="grand_total">{{ $total+50 }}</span></strong><sup>৳</sup></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    @endif
                                    <div class="row">
                                        <div class="col-md-8 col-lg-8 col-6">
                                            <a href="{{ route('home') }}" class="btn btn-info">CONTINUE SHOPPING</a>
                                        </div>
                                        <div class="col-md-4 col-lg-4 col-6">
                                            <input type="submit" class="btn btn-success btn-sm" value="CONFIRM ORDER" name="_confirm">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </form>
    @else
        <div class="container">
            <button onclick="myLoginFunction()" class="btn btn-info btn-hover my-2">Already have an account?</button>
            <div id="loginFrom" style="display: none;">
                <form action="{{ route('customer.check') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="cart_table_area">
                                    <strong>
                                        Login Information
                                    </strong>
                                </div>
                                <div class="panel-body panel_area">
                                    <div class="form-group">
                                        <label>Email Address</label>
                                        <input type="text" class="form-control" name="email"  placeholder="Email" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" name="password"  placeholder="Password" required>
                                    </div>
                                    <input type="submit" class="btn btn-info" value="Login Now">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <form action="{{ route('customer.checkout.store') }}" method="POST" >
            @csrf
            <section class="pad-tb-25 mt-20">
                <div class="container">
                    <div class="row" style="font-size:14px;">
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="alert panel_bg">
                                    <strong>
                                        Billing Information
                                    </strong>
                                </div>
                                <div class="panel-body panel_area">
                                    <div class="form-group">
                                        <label>Full Name</label>
                                        <input type="text" class="form-control" name="billing_name" placeholder="Your Name" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="billing_email" placeholder="Your Email" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" id="phone" class="form-control" placeholder="Phone Number" name="billing_phone" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Address</label>
                                        <textarea class="form-control" name="billing_address" placeholder="Your Address" required>
                                            
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <a onclick="myAccountPass()" class="btn btn-info btn-hover" style="color: white;">Create an Account ?</a>
                                    </div>
                                    <div class="form-group" id="accountPass" style="display: none;">
                                        <label>Password</label>
                                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                                    </div>
                                </div>
                            </div>
                            <div class="checkbox">
                                {{-- <label><input type="checkbox" name="check_shipping" checked>Ship to this address</label> --}}
                            </div>
                            <div id="" class="panel panel-default">
                                <div class="alert panel_bg" onclick="myShippingInfo()">
                                    <strong>
                                        Shipping Information
                                    </strong>
                                </div>
                                <div class="panel-body panel_area" id="showShippingAddress" style="display: none;">
                                    <div class="form-group">
                                        <label>Full Name</label>
                                        <input type="text" class="form-control" name="shipping_name"  placeholder="Your Name">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="shipping_email"  placeholder="Your Email">
                                    </div>
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" id="phone" class="form-control" placeholder="Phone Number" name="shipping_phone">
                                    </div>
                                    <div class="form-group">
                                        <label>Address</label>
                                        <textarea class="form-control" name="shipping_address" placeholder="Your Address">
                                            
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="alert panel_bg">
                                    <strong>
                                        Payment Method
                                    </strong>
                                </div>
                                <div class="panel-body panel_area">
                                    <div class="form-group">
                                        <strong>Payment Method</strong>
                                        <span class="pull-right">
                                            <select name="payment_method" class="form-control">
                                                <option value="Cash" selected >Cash On Delivery</option>
                                            </select>
                                        </span>
                                    </div>
                                    <hr style="margin: 30px; padding: 0px;" />
                                    <h5 class="pb-10">
                                        <strong>Shipping</strong>
                                        <span class="pull-right">
                                            <select name="shipping_charge" id="shipping_charge">
                                                <option value="50">Inside Dhake 50 BDT</option>
                                                <option value="120">Outside Dhake 120 BDT</option>
                                            </select>
                                        </span>
                                    </h5>
                                    <hr style="margin: 30px; padding: 0px;" />
                                </div>
                            </div>
                            <div class="panel panel-success ">
                                <div class="alert panel_bg mt-10">
                                    <strong>
                                        Summary
                                    </strong>
                                </div>
                                <div class="panel-body panel_area">
                                    @if (session('cart'))
                                    @php
                                        $total = 0;
                                    @endphp
                                        <h5>{{count(session('cart'))}} Product in cart</h5>

                                        <table class="table table-responsive table-bordered" style="font-size:14px;background-color:#FFF;">
                                            <tbody>
                                            @foreach (session('cart') as $id => $details)
                                            @php
                                                $total += $details['sell_price'] * $details['quantity'];
                                            @endphp
                                                <tr>
                                                <input type="hidden" name="product_id[]" value="{{ $id }}">
                                                <input type="hidden" name="quantity[]" value="{{ $details['quantity'] }}">
                                                <input type="hidden" name="size_id[]" value="@if ($details['size_id'])
                                                    {{ $details['size_id'] }}
                                                @else
                                                no
                                                @endif">
                                                <input type="hidden" name="colour_id[]" value="@if ($details['colour_id'])
                                                    {{ $details['colour_id'] }}
                                                @else
                                                no
                                                @endif">
                                                    <td><img src="{{ URL::to($details['image']) }}" height="75px"></td>
                                                    <td style="font-size:16px;">
                                                        <strong>{{$details['title'] }}</strong>
                                                    </td>
                                                    <td><strong>{{$details['sell_price']}}</strong><sup>৳</sup> x <strong>{{$details['quantity']}}</strong></td>
                                                    <td><strong>{{ $details['sell_price'] * $details['quantity'] }}</strong><sup>৳</sup></td>
                                                </tr>
                                            @endforeach
                                                <tr>
                                                    <input type="hidden" name="subtotal" value="{{ $total }}" id="sub_total">
                                                    <td colspan="3" style="text-align:right;">Subtotal</td>
                                                    <td><strong>{{ $total }}</strong><sup>৳</sup></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" style="text-align:right;">Shipping Charge</td>
                                                    <td><strong><span id="shipping_total">50</span></strong><sup>৳</sup></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" style="text-align:right;">Gift Wrap</td>
                                                    <td><strong><span id="waraper_total">0</span></strong><sup>৳</sup></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" style="text-align:right;"><strong>GRAND TOTAL</strong></td>
                                                    <td><strong><span id="grand_total">{{ $total+50 }}</span></strong><sup>৳</sup></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    @endif
                                    <div class="row">
                                        <div class="col-md-8 col-lg-8 col-6">
                                            <a href="{{ route('home') }}" class="btn btn-info">CONTINUE SHOPPING</a>
                                        </div>
                                        <div class="col-md-4 col-lg-4 col-6">
                                            <input type="submit" class="btn btn-success btn-sm" value="CONFIRM ORDER" name="_confirm">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </form>
    @endauth
@endsection

@push('js')
    <script>    
        function myLoginFunction() {
            var x = document.getElementById("loginFrom");
            if (x.style.display === "none") {
                x.style.display = "block";
            }else {
                x.style.display = "none";
            }
        }
    </script>
    <script>
        function myAccountPass() {
            var x = document.getElementById("accountPass");
            if (x.style.display === "none") {
                x.style.display = "block";
            }else {
                x.style.display = "none";
            }
        }
    </script>
    <script>    
        function myShippingInfo() {
            var x = document.getElementById("showShippingAddress");
            if (x.style.display === "none") {
                x.style.display = "block";
            }else {
                x.style.display = "none";
            }
        }
    </script>
    <script src="{{ asset('js/checkout.js') }}"></script>
@endpush
