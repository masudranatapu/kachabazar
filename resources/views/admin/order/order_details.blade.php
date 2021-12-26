@extends('layouts.backend.app')

@section('title')
    {{$title}}
@endsection

@push('css')

@endpush

@section('content')
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Order Details</li>
      </ol>
    </section>

    <div class="clearfix">
        <div class="pro_back">
            <div class="container-fluid d_table">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>ORDER: {{$order->order_code}} <span class="label label-warning">{{$order->order_status}}</span></h4>
                        </div>
                        <div class="col-md-6">
                            <span class="pull-right">
                                Date : {{ $order->created_at->format('d M Y h:i A') }}
                                <form id="status_form_{{$order->id}}" action="{{ route('admin.order_status_change') }}" method="POST" >
                                    @csrf
                                        <input type="hidden" name="order_id" 
                                        value="{{$order->id}}">

                                        <div class="form-group row">
                                            <label for="" class="col-xs-5 col-form-label">Status :</label>
                                            <div class="col-xs-7 text-right">                      
                                                <select name="order_status" id="order_status" onchange="this.form.submit()" >
                                                    <option 
                                                @if ($order->order_status=='Pending') selected @endif
                                                    value="Pending">Pending</option>
                                                    <option 
                                                @if ($order->order_status=='Confirmed') selected @endif
                                                    value="Confirmed">Confirmed</option>
                                                    <option 
                                                @if ($order->order_status=='Processing') selected @endif
                                                    value="Processing">Processing</option>
                                                    <option 
                                                @if ($order->order_status=='Delivered') selected @endif
                                                    value="Delivered">Delivered</option>
                                                    <option 
                                                @if ($order->order_status=='Successed') selected @endif
                                                    value="Successed">Successed</option>
                                                    <option 
                                                @if ($order->order_status=='Canceled') selected @endif
                                                    value="Canceled">Canceled</option>
                                                </select>
                                            </div>
                                        </div>

                                </form>
                            </span>
                        </div>
                    </div>
                    <hr style="margin: 0.5rem auto 2.2rem;">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Shipping Address
                                </div><!-- End .card-header -->

                                <div class="panel-body">
                                    <p>
                                      <strong>Name : </strong> {{$shipping_address->name}}<br>                
                                      <strong>Phone : </strong> {{$shipping_address->phone}}<br>                
                                      <strong>E-mail : </strong> {{$shipping_address->email}}<br>                
                                      <strong>Address : </strong> {{$shipping_address->address}}
                                    </p>
                                </div><!-- End .card-body -->
                            </div><!-- End .card -->
                        </div><!-- End .col-md-6 -->

                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Billing Address
                                </div><!-- End .card-header -->

                                <div class="panel-body">
                                    <p>
                                      <strong>Name : </strong> {{$billingaddress->name}}<br>                
                                      <strong>Phone : </strong> {{$billingaddress->phone}}<br>                
                                      <strong>E-mail : </strong> {{$billingaddress->email}}<br>                
                                      <strong>Address : </strong> {{$billingaddress->address}}
                                    </p>
                                </div><!-- End .card-body -->
                            </div><!-- End .card -->
                        </div><!-- End .col-md-6 -->
                    </div><!-- End .row -->
                    

                    <div class="well" style="min-height: auto;">
                        <p>
                            <strong>Payment method :</strong> {{$order->payment_method}} <br>
                            <strong>Payment status :</strong> {{$order->status}} <br>
                            <strong>Order type :</strong> {{$order->order_type}}
                        </p>
                    </div>

                    <div class="table-responsive">
                @php
                    $product_id = explode(",",$order->product_id);
                    $quantity = explode(",",$order->quantity);
                    $size_id = explode(",",$order->size_id);
                    $colour_id = explode(",",$order->colour_id);
                @endphp
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
                                  $quantity = explode(",",$order->quantity);
                              @endphp
                                  @foreach($product_id as $key=>$product_id)
                              @php
                                  $product = App\Product::find($product_id);

                                  $purchase = App\Purchase::where('product_id',$product->id)->sum('quantity');
                                  $sold = App\Sold::where('product_id',$product->id)->sum('quantity');
                                  $stock = $purchase-$sold;
                              @endphp
                                <tr>                                
                                  <td><img src="{{ Storage::disk('public')->url('product/'.$product->cover_photo) }}" height="75px"></td>
                                  <td style="font-size:16px;">
                                        <strong>{{ $product->title }}</strong>
                                        <br> 
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
                                            @endif<br />
                                        <small>ID # {{$product->product_code}}</small><br>
                                        <small>Stock : {{ $stock }}</small>
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
    
@endsection

@push('js')

@endpush