@extends('layouts.frontend.app')

@section('title')
	{{$title}}
@endsection

@section('meta')

@endsection

@push('css')
    <style>
        .alert {
            margin-bottom: 0 !important;
            border-radius: 0 !important;
            border-top-right-radius: 5px !important;
            border-top-left-radius: 5px !important;
        }
        .panel_area{
            border: solid 1px #d0cdcd;
            padding: 20px 10px;
            margin-bottom: 10px;
        }
        .hover_input {
            cursor: pointer;
        }
        .cart_table_area {
            padding-left: 14px;
            padding-top: 13px;
            color: white;
            padding-bottom: 13px;
            background: #0D7E40;
        }
        .btn-hover:hover {
            cursor: pointer;
        }
    </style>
@endpush

@section('content')
    <div class="breadcrumbs_area commun_bread">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="{{ route('home') }}"><strong>HOME</strong></a></li>
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
                                <div class="cart_table_area">
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
                                        <input type="email" class="form-control" name="billing_email" value="{{Auth::user()->email}}" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Area / Division</label>
                                                <select id="division_id" name="div_id" class="form-control" required>
                                                    <option value="">Select One</option>
                                                    @foreach($divisions as $division)
                                                        <option onclick="getShippingFee(this.id)" id="{{$division->id}}" value="{{$division->id}}">{{$division->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6" style="padding-right: 17px;">
                                            <div class="form-group">
                                                <label>Zone</label>
                                                <select name="dis_id" id="district" class="form-control"  style="display:block">

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Delivary Days</label>
                                                <input type="text" readonly id="days" name="billing_delivery_day" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone</label>
                                                <input required type="text" id="phone" class="form-control" name="billing_phone" value="{{Auth::user()->phone}}" required>
                                            </div>
                                        </div>
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
                            <input type="button" onclick="myFunction()" class="mb-10 hover_input form-control text-white bg-success" value="Shipping Information">
                            <div id="myDIV" class="panel panel-default" style="display: none;">
                                <div class="cart_table_area">
                                    <strong>
                                        Shipping Information
                                    </strong>
                                </div>
                                <div class="panel-body panel_area">
                                    <div class="form-group">
                                        <label>Full Name</label>
                                        <input type="text" class="form-control" name="shipping_name" value="{{Auth::user()->name}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="shipping_email" value="{{Auth::user()->email}}" required >
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Area / Division</label>
                                                <select id="id_division" name="s_div_id" class="form-control" >
                                                    <option value="">Select One</option>
                                                    @foreach($divisions as $division)
                                                        <option value="{{$division->id}}">{{$division->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6" style="padding-right: 17px;">
                                        <div class="form-group">
                                                <label>Zone</label>
                                                <select id="id_district" name="s_dis_id" id="district" class="form-control"  style="display:block">
                                            </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Delivary Days</label>
                                                <input type="text" readonly id="dayes" name="shipping_delivery_day" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone</label>
                                                <input required type="text" id="phone" class="form-control" name="shipping_phone" value="{{Auth::user()->phone}}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Address</label>
                                        <textarea class="form-control" name="shipping_address" placeholder="Your Address" required>{{Auth::user()->address}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="cart_table_area">
                                    <strong>
                                        Payment Method
                                    </strong>
                                </div>
                                <div class="panel-body panel_area">
                                    <div class="form-group">
                                        <select name="payment_method" class="form-control payment_phone_number" required id="payment_method_select">
                                            <option value="" disabled="" selected="">Choose Your Payment Method</option>
                                            @foreach($payments as $payment)
                                                <option value="{{$payment->name}}">{{$payment->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group" id="mobile_payment" style="display: none;">
                                        <p class="bg-success text-white pl-2"> <span id="bkash_or_rocket"></span> Agent Number: <span id="payment_number"></span></p>
                                        <label><strong>Mobile No</strong></label>
                                        <input type="text" class="form-control" name="payment_mobile_no" placeholder="Enter mobile no">
                                        <label><strong>Transection ID</strong></label>
                                        <input type="text" class="form-control" name="transaction_id" placeholder="Enter TrxID">
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="cart_table_area">
                                    <strong>
                                        Apply Coupon
                                    </strong>
                                </div>
                                <div class="panel-body panel_area">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="coupon_code" placeholder="Enter coupon code">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-success">
                                <div class="cart_table_area">
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
                                                    <input type="hidden" name="shipping_charge" value="0" id="shipping_charge">
                                                    <td colspan="3" style="text-align:right;">Subtotal</td>
                                                    <td><strong>{{ $total }}</strong><sup>৳</sup></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" style="text-align:right;">Shipping Charge For Your Area</td>
                                                    <td>
                                                        <strong>
                                                            <span id="area_and_distric_fee"></span>
                                                        </strong>
                                                        <sup>৳</sup>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" style="text-align:right;"><strong>GRAND TOTAL</strong></td>
                                                    <td><strong><span id="grand_total">{{ $total }}</span></strong><sup>৳</sup></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    @endif
                                    <div class="row">
                                        <div class="col-md-8 col-lg-8 col-6">
                                            <a href="{{ route('home') }}" class="btn btn-success">CONTINUE SHOPPING</a>
                                        </div>
                                        <div class="col-md-4 col-lg-4 col-6">
                                            <input type="submit" class="btn btn-sm btn-success" value="CONFIRM ORDER" name="_confirm">
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
            <button onclick="myLoginFunction()" class="btn btn-success btn-hover my-2">Already have an account?</button>
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
                                <div class="cart_table_area">
                                    <strong>
                                        Billing Information
                                    </strong>
                                </div>
                                <div class="panel-body panel_area">
                                    <div class="form-group">
                                        <label>Full Name</label>
                                        <input type="text" class="form-control" name="billing_name"  placeholder="Your Name" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="billing_email"  placeholder="Your Email" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Area / Division </label>
                                                <select id="division_id" name="div_id" class="form-control" required>
                                                    <option value="">Select One</option>
                                                    @foreach($divisions as $division)
                                                        <option onclick="getShippingFee(this.id)" id="{{$division->id}}" value="{{$division->id}}">{{$division->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6" style="padding-right: 17px;">
                                            <div class="form-group">
                                                <label>Zone</label>
                                                <select name="dis_id" id="district" class="form-control zone"  style="display:block">

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Delivary Days</label>
                                                <input type="text" readonly id="days" name="billing_delivery_day" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone</label>
                                                <input required type="text" id="phone" class="form-control" name="billing_phone" placeholder="Your Phone" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Address</label>
                                        <textarea class="form-control" name="billing_address" placeholder="Your Address" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button onclick="myAccountPass()" class="btn btn-success btn-hover">Create an Account ?</button>
                                    </div>
                                    <div class="form-group" id="accountPass" style="display: none;">
                                        <label>Password</label>
                                        <input type="password" name="password" class="form-control" placeholder="Password">
                                    </div>
                                </div>
                            </div>

                            <input type="button" onclick="myFunction()" class="mb-10 hover_input bg-success text-white form-control" value="Shipping Information">

                            <div id="myDIV" class="panel panel-default" style="display: none;">
                                <div class="cart_table_area">
                                    <strong>
                                        Shipping Information
                                    </strong>
                                </div>
                                <div class="panel-body panel_area">
                                    <div class="form-group">
                                        <label>Full Name</label>
                                        <input type="text" class="form-control" name="shipping_name" placeholder="Your Name">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="shipping_email" placeholder="Email Address" >
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Area / Division</label>
                                                <select id="id_division" name="s_div_id" class="form-control" >
                                                    <option value="">Select One</option>
                                                    @foreach($divisions as $division)
                                                        <option value="{{$division->id}}">{{$division->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6" style="padding-right: 17px;">
                                        <div class="form-group">
                                                <label>Zone</label>
                                                <select id="id_district" name="s_dis_id" id="district" class="form-control"  style="display:block">

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Delivary Days</label>
                                                <input type="text" readonly id="dayes" name="shipping_delivery_day" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone</label>
                                                <input type="text" id="phone" class="form-control" name="shipping_phone" placeholder="Phone Number">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Address</label>
                                        <textarea class="form-control" name="shipping_address" placeholder="Your Address"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="cart_table_area">
                                    <strong>
                                        Payment Method
                                    </strong>
                                </div>
                                <div class="panel-body panel_area">
                                    <div class="form-group">
                                        <select name="payment_method" class="form-control payment_phone_number" required id="payment_method_select">
                                            <option value="" disabled="" selected="">Choose Your Payment Method</option>
                                            @foreach($payments as $payment)
                                                <option value="{{$payment->name}}">{{$payment->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group" id="mobile_payment" style="display: none;">
                                        <p class="bg-success text-white pl-2"> <span id="bkash_or_rocket"></span> Agent Number: <span id="payment_number"></span></p>
                                        <label><strong>Mobile No</strong></label>
                                        <input type="text" class="form-control" name="payment_mobile_no" placeholder="Enter mobile no">
                                        <label><strong>Transection ID</strong></label>
                                        <input type="text" class="form-control" name="transaction_id" placeholder="Enter TrxID">
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="cart_table_area">
                                    <strong>
                                        Apply Coupon
                                    </strong>
                                </div>
                                <div class="panel-body panel_area">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="coupon_code" placeholder="Enter coupon code">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-success">
                                <div class="cart_table_area">
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
                                                    <input type="hidden" name="shipping_charge" value="0" id="shipping_charge">
                                                    <td colspan="3" style="text-align:right;">Subtotal</td>
                                                    <td><strong>{{ $total }}</strong><sup>৳</sup></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" style="text-align:right;">Shipping Charge For Your Area</td>
                                                    <td>
                                                        <strong>
                                                            <span id="area_and_distric_fee"></span>
                                                        </strong>
                                                        <sup>৳</sup>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" style="text-align:right;"><strong>GRAND TOTAL</strong></td>
                                                    <td><strong><span id="grand_total">{{ $total }}</span></strong><sup>৳</sup></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    @endif
                                    <div class="row">
                                        <div class="col-md-8 col-lg-8 col-6">
                                            <a href="{{ route('home') }}" class="btn btn-success">CONTINUE SHOPPING</a>
                                        </div>
                                        <div class="col-md-4 col-lg-4 col-6">
                                            <input type="submit" class="btn btn-sm btn-success" value="CONFIRM ORDER" name="_confirm">
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
        $("#payment_method_select").change(function () {
            var payment_method_select = $(this).val();
            if(payment_method_select == 'Bkash'){
                document.getElementById("bkash_or_rocket").innerHTML = "BKash";
                $("#mobile_payment").show();
            }else if(payment_method_select == 'Rocket'){
                document.getElementById("bkash_or_rocket").innerHTML = "Rocket";
                $("#mobile_payment").show();
            }else if(payment_method_select == 'Nagad') {
                document.getElementById("bkash_or_rocket").innerHTML = "Nagad";
                $("#mobile_payment").show();
            }else{
                $("#mobile_payment").hide();
            }
        });
    </script>
    <script src="{{ asset('js/checkout.js') }}"></script>
    <script>
        function myFunction() {
            var x = document.getElementById("myDIV");
            if (x.style.display === "none") {
                x.style.display = "block";
            }else {
                x.style.display = "none";
            }
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#division_id').on('change', function(){
                var division_id = $(this).val();
                var sub_total = parseInt($('#sub_total').val());
                if(division_id) {
                    $.ajax({
                        url: "{{  url('customer/division/district/ajax') }}/"+division_id ,
                        type:"GET",
                        dataType:"json",
                        success:function(data) {
                            $('#district').empty();
                            $('#district').append('<option value=""> Select One </option>');
                            $.each(data[1], function(key, value){
                                $('#district').append('<option value="'+ value.id +'">' + value.name + '</option>');
                            });
                            $('#area_and_distric_fee').text(data[0]);
                            $('#grand_total').text(parseInt(data[0]) + sub_total);
                            $('#shipping_charge').val(data[0]);
                        },
                    });
                }else {
                    alert('Danger');
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#id_division').on('change', function(){
                var id_division = $(this).val();
                var sub_total = parseInt($('#sub_total').val());
                if(id_division) {
                    $.ajax({
                        url: "{{  url('customer/district/division/ajax') }}/"+id_division ,
                        type:"GET",
                        dataType:"json",
                        success:function(data) {
                            $('#id_district').empty();
                            $('#id_district').append('<option value=""> Select One </option>');
                            $.each(data[1], function(key, value){
                                $('#id_district').append('<option value="'+ value.id +'">' + value.name + '</option>');
                            });
                            $('#area_and_distric_fee').text(data[0]);
                            $('#grand_total').text(parseInt(data[0]) + sub_total);
                            $('#shipping_charge').val(data[0]);
                            $('#days').val(data[1]);
                        },
                    });
                }else {
                    alert('Danger');
                }
            });
        });
    </script>
    <script type="text/javascript">        
        $(document).ready(function() {
            $('#district').on('change', function(){
                var district = $(this).val();
                var sub_total = parseInt($('#sub_total').val());
                if(district) {
                    $.ajax({
                        url: "{{  url('customer/thana/ajax') }}/"+district ,
                        type:"GET",
                        dataType:"json",
                        success:function(data) {
                            $('#area_and_distric_fee').text(data[0]);
                            $('#grand_total').text(parseInt(data[0]) + sub_total);
                            $('#shipping_charge').val(data[0]);
                            $('#days').val(data[1]);
                        },
                    });
                }else {
                    alert('Danger');
                }
            });
        });
    </script>
    <script type="text/javascript">        
        $(document).ready(function() {
            $('#id_district').on('change', function(){
                var id_district = $(this).val();
                var sub_total = parseInt($('#sub_total').val());
                if(id_district) {
                    $.ajax({
                        url: "{{  url('customer/another_thana/ajax') }}/"+id_district ,
                        type:"GET",
                        dataType:"json",
                        success:function(data) {
                            $('#area_and_distric_fee').text(data[0]);
                            $('#grand_total').text(parseInt(data[0]) + sub_total);
                            $('#dayes').val(data[1]);
                        },
                    });
                }else {
                    alert('Danger');
                }
            });
        });
    </script>
    <script>
        $(".payment_phone_number").change(function() {
            var payment_name = $(this).val();
            $.ajax({
                type:"POST",
                url:"{{ route('payment_phone') }}",
                data:{
                        payment_name: payment_name,
                        _token: '{{csrf_token()}}'
                    },
                success:function(data) {
                    $("#payment_number").html(data);
                }
            });
        });
    </script>
@endpush