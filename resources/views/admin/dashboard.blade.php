@extends('layouts.backend.app')

@section('title')
    Dashboard
@endsection

@section('content')
  <section class="content-header">
    <h1>
      Dashboard <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li>
        <a href="{{ route('admin.dashboard') }}">
          <i class="fa fa-dashboard"></i>
          Home
        </a>
      </li>
      <li class="active">Dashboard</li>
    </ol>
  </section>
  <section class="content">
    <div class="row bg-info">
      <div class="col-md-12">
        <div class="row">
          <form action="{{ route('admin.order.search') }}" mathoad="GET">
            @csrf
            <div class="col-md-3">
              <h3>Tracking Your Order Now</h3>
              <p>Your order information</p>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label >Product Name</label>
                <select name="product_code" id="" class="form-control">
                  <option value="" disabled selected>Select One</option>
                  @foreach($products as $product)
                    <option value="{{ $product->product_code }}"> {{$product->title }} - {{ $product->product_code }} </option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label >Area or Zone </label>
                <select name="area_zone" id="" class="form-control">
                  <option value="" disabled selected>Select One</option>
                  @foreach($districts as $district)
                    <option value="{{ $district->id }}">{{  $district->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label >Start Date</label>
                <input type="date" name="start_date" class="form-control">
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label >End Date </label>
                <input type="date" name="end_date" class="form-control">
              </div>
            </div>
            <div class="col-md-1">
              <div class="form-group">
                <label for=""></label><br>
                <input type="submit" class="btn btn-success forom-control w-100" value="Find Order">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <hr>
    <div class="row">
      <section class="small_containt">
        <div class="col-lg-3 col-xs-6 clearfix">
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{ $products->count() }}</h3>
              <p>Product</p>
            </div>
            <div class="icon">
              <i class="fa fa-cubes"></i>
            </div>
            <a href="{{ route('admin.product.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6 clearfix">
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{$order_pending}}</h3>
              <p>Pending Orders</p>
            </div>
            <div class="icon">
              <i class="fa fa-paper-plane-o"></i>
            </div>
            <a href="{{ route('admin.pending_order') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6 clearfix">
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$order_Confirmed}}</h3>
              <p>Confirmed Orders</p>
            </div>
            <div class="icon">
              <i class="fa fa-check-square-o"></i>
            </div>
            <a href="{{ route('admin.confirmed_order') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6 clearfix">
          <div class="small-box bg-primary">
            <div class="inner">
              <h3>{{$order_Processing}}</h3>
              <p>Processing Orders</p>
            </div>
            <div class="icon">
              <i class="fa fa-spinner"></i>
            </div>
            <a href="{{ route('admin.processing_order') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6 clearfix">
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$order_Delivered}}</h3>

              <p>Delivered Orders</p>
            </div>
            <div class="icon">
              <i class="fa fa-bicycle"></i>
            </div>
            <a href="{{ route('admin.delivered_order') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6 clearfix">
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{$order_Successed}}</h3>
              <p>Succeed orders</p>
            </div>
            <div class="icon">
              <i class="fa fa-handshake-o"></i>
            </div>
            <a href="{{ route('admin.successed_order') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6 clearfix">
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{$order_Canceled}}</h3>
              <p>Canceled orders</p>
            </div>
            <div class="icon">
              <i class="fa fa-trash-o"></i>
            </div>
            <a href="{{ route('admin.canceled_order') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6 clearfix">
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{$allorder}}</h3>
              <p>Total Orders</p>
            </div>
            <div class="icon">
              <i class="fa fa-cart-plus"></i>
            </div>
            <a href="{{ route('admin.all_order') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6 clearfix">
          <div class="small-box bg-primary">
            <div class="inner">
              <h3>{{$messeges}}</h3>
              <p>Message</p>
            </div>
            <div class="icon">
              <i class="fa fa-comments-o"></i>
            </div>
            <a href="{{ route('admin.message.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </section>
    </div>
  </section>
@endsection
