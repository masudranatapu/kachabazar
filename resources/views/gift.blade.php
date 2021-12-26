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
                            <li>Gift</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>         
    </div>
    <form action="{{ route('gift_store') }}" method="POST" >
        @csrf
        <section class="pad-tb-25 mt-10">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="panel panel-default">
                            <div class="alert panel_bg">
                                <h4 style="font-size:14px;font-weight:600;text-transform:uppercase;">Gift From</h4>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <input type="text" class="form-control" name="billing_name" value="" placeholder="Your Name" required>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="billing_email" value="" placeholder="Your Email">
                                </div>
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input required type="text" id="phone" class="form-control" placeholder="Phone Number" name="billing_phone" value="">
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea class="form-control" name="billing_address" placeholder="Your Address" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="checkbox">
                          {{-- <label><input type="checkbox" name="check_shipping" checked>Ship to this address</label> --}}
                        </div>
                        <div id="" class="panel panel-default">
                            <div class="alert panel_bg">
                                <h4 style="font-size:14px;font-weight:600;text-transform:uppercase;">Gift To</h4>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <input type="text" class="form-control" name="shipping_name" value="" placeholder="Your Name" required>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="shipping_email" value="" placeholder="Your Email">
                                </div>
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input required type="text" id="phone" class="form-control" placeholder="Phone Number" name="shipping_phone" value="">
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea class="form-control" name="shipping_address" placeholder="Your Address" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="alert panel_bg">
                                <h4 style="font-size:14px;font-weight:600;text-transform:uppercase;"> Others info</h4>
                            </div>
                            <div class="panel-body">
                                <input type="hidden" name="payment_method" value="Online">
                                <h5><strong>Shipping</strong> <span class="pull-right">
                                    <select name="shipping_charge" id="shipping_charge">
                                        <option value="50">Inside Dhake 50 BDT</option>
                                        <option value="120">Outside Dhake 120 BDT</option>
                                    </select>
                                </h5>
                                <hr />
                                <h5>
                                    <div class="checkbox">
                                      <label><input type="checkbox" name="waraper" id="waraper" value="20"><strong>Gift Wrap for Tk. 20</strong></label>
                                    </div>
                                </h5>
                            </div>
                        </div>
                        <div class="panel panel-success">
                            <div class="panel-body">
                                @if (session('cart'))
                                @php
                                    $total = 0;
                                @endphp
                                    <h5><strong>Summary</strong></h5>
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
                                                <td><img src="{{ Storage::disk('public')->url('product/'.$details['image']) }}" height="75px"></td>
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
                                    <div class="col-md-6">
                                        <a href="{{ route('home') }}" class="btn btn-info">CONTINUE SHOPPING</a>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="submit" class="btn btn-success mb-10" value="BUY NOW" name="_confirm">
                                    </div>
                                </div>
                            </div>
                        </div>                       
                    </div>
                </div>
            </div>
        </section>
    </form>
@endsection

@push('js')
    <script src="{{ asset('js/checkout.js') }}"></script>
@endpush