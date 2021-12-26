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
                        <li>Order View</li>
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
                @include('layouts.frontend.partial.coustomer_sidebar')
              </div>
              <div class="col-md-9">
                <div class="alert panel_bg">
                    <strong>
                        Order # {{$order->order_code}}
                    </strong>
                </div>
                <div class="row ">

                    <div class="col-md-6">
                        <div class="panel panel-default panel_area">
                            <div class="panel-heading"><h4 style="font-size:14px;font-weight:600;">SHIPPING ADDRESS</h4></div>
                              <div class="panel-body">
                                  <h5><strong>Name</strong> : {{$shipping_address->name}}</h5>
                                  <h5><strong>Phone</strong> : {{$shipping_address->phone}}</h5>
                                  <h5><strong>Mail</strong> : {{$shipping_address->email}}</h5>
                                  <h5><strong>Address</strong> : {{$shipping_address->address}}</h5>
                              </div>
                          </div>
                      </div>

                    <div class="col-md-6">
                        <div class="panel panel-default panel_area">
                            <div class="panel-heading"><h4 style="font-size:14px;font-weight:600;">BILLING ADDRESS</h4></div>
                              <div class="panel-body">
                                  <h5><strong>Name</strong> : {{$billingaddress->name}}</h5>
                                  <h5><strong>Phone</strong> : {{$billingaddress->phone}}</h5>
                                  <h5><strong>Mail</strong> : {{$billingaddress->email}}</h5>
                                  <h5><strong>Address</strong> : {{$billingaddress->address}}</h5>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-12">
                        <div class="thumbnail">
                            <h5><strong>PAYMENT METHOD:</strong> {{$order->payment_method}}</h5>
                            <h5><strong>PAYMENT STATUS:</strong>
                                @if($order->order_status == 'Delivered' || $order->order_status == 'Successed')
                                    <span class="badge" style="background: green; color: white;">Payment Success</span>
                                @elseif($order->order_status == 'Processing')
                                    <span class="badge bg-info" style="color: white;">Payment Processing</span>
                                @elseif($order->order_status == 'Canceled')
                                    <span class="badge" style="background: red; color: white;">Payment Cancel</span>
                                @else
                                    <span class="badge bg-warning" style="color: white;">Payment Pending</span>
                                @endif
                            </h5>
                          </div>
                      </div>

                      <div class="col-md-12  table-responsive">
                          <table class="table table-bordered" style="font-size:14px;background-color:#FFF;">
                            <thead>
                                <tr>
                                    <th width="20">Photo</th>
                                    <th width="50%">Product Name</th>
                                    <th width="10">Price</th>
                                    <th width="10">Qty</th>
                                    <th width="10">Subtotal</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @php
                                    $product_id = explode(",",$order->product_id);
                                    $size_id = explode(",",$order->size_id);
                                    $colour_id = explode(",",$order->colour_id);
                                    $quantity = explode(",",$order->quantity);
                                @endphp
                                    @foreach($product_id as $key=>$product_id)
                                @php
                                    $product = App\Product::find($product_id);
                                @endphp
                                  <tr>
                                    <td><img src="{{ URL::to($product->cover_photo) }}" height="75px"></td>
                                    <td style="font-size:16px;">
                                          <strong>{{ $product->title }}</strong><br>
                                            @if (!($size_id[$key] == 'no'))
                                        @php
                                            $size = App\Size::find($size_id[$key]);
                                        @endphp
                                                Size : {{$size->name}}<br>
                                            @endif

                                            @if (!($colour_id[$key] == 'no'))
                                        @php
                                            $colour = App\Colour::find($colour_id[$key]);
                                        @endphp
                                                Colour : {{$colour->name}}
                                            @endif
                                          <br/>
                                          <small>ID # {{$product->product_code}}</small>
                                      </td>
                                    <td><strong>{{ $product->sell_price }}</strong><sup>৳</sup></td>
                                    <td><strong>{{ $quantity[$key] }}</strong></td>
                                    <td><strong>{{ $product->sell_price * $quantity[$key]}}</strong><sup>৳</sup></td>
                                  </tr>
                                @endforeach

                                  <tr>
                                    <td colspan="4" style="text-align:right;">Subtotal</td>
                                      <td><strong>{{ $order->subtotal }}</strong><sup>৳</sup></td>
                                  </tr>
                                  <tr>
                                    <td colspan="4" style="text-align:right;">Shipping Charge</td>
                                      <td><strong>{{ $order->shipping_charge }}</strong><sup>৳</sup></td>
                                  </tr>
                                  <tr>
                                    <td colspan="4" style="text-align:right;">Gift Wrap</td>
                                      <td><strong>{{ $order->waraper }}</strong><sup>৳</sup></td>
                                  </tr>
                                  <tr>
                                    <td colspan="4" style="text-align:right;"><strong>GRAND TOTAL</strong></td>
                                      <td><strong>{{ $order->total }}</strong><sup>৳</sup></td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>

                  </div>


              </div>

          </div>
      </div>
  </section>

@endsection

@push('js')


@endpush
