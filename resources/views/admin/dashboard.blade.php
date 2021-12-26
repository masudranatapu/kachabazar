@extends('layouts.backend.app')
@section('title')
    Dashboard
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <section class="small_containt">
          <div class="col-lg-3 col-xs-6 clearfix">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                <h3>{{$product}}</h3>

                <p>Product</p>
              </div>
              <div class="icon">
                <i class="fa fa-cubes"></i>
              </div>
              <a href="{{ route('admin.product.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-xs-6 clearfix">
                <!-- small box -->
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
                <!-- small box -->
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
                <!-- small box -->
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
                <!-- small box -->
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
                <!-- small box -->
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
                <!-- small box -->
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
                <!-- small box -->
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
            <!-- small box -->
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
      <!-- /.row (main row) -->
    </section>
    <!-- /.content -->
@endsection
