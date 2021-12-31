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
          <form action="{{ route('admin.order.search') }}" mathoad="get">
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
        
    </div>
  </section>
@endsection
