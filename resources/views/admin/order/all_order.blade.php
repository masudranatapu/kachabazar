@extends('layouts.backend.app')

@section('title')
    {{$title}}
@endsection

@push('css')

@endpush

@section('content')
    <section class="content-header">
      <ol class="breadcrumb">
      <li>
        <a href="{{ route('admin.dashboard') }}">
          <i class="fa fa-dashboard"></i>
          Home
        </a>
      </li>
        <li class="active">Orders</li>
      </ol>
    </section>

    <div class="clearfix">
        <div class="pro_back">
            <div class="container-fluid d_table">
                <!-- Exportable Table -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    <strong>{{$title}}</strong>
                                    <span class="badge bg-blue">{{ $orders->count() }}</span>
                                </h2>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                        <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Order ID</th>
                                            <th>Order Date</th>
                                            <th>Total</th>
                                            <th>Pyment Method</th>
                                            <th>Pyment Status</th>
                                            <th>Order As</th>
                                            <th class="text-center">Order Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($orders as $key=>$order)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{ $order->order_code }}</td>
                                                    <td>{{ $order->created_at->format('d M Y h:i A') }}</td>
                                                    <td><strong>{{ $order->total }}<sup>৳</sup></strong></td>
                                                    <td>{{ $order->payment_method }}</td>
                                                    <td>{{ $order->status }}</td>
                                                    <td>{{ $order->order_type }}</td>
                                                    <td class="text-center">
                            <form id="status_form_{{$order->id}}" action="{{ route('admin.order_status_change') }}" method="POST" >
                                @csrf
                                    <input type="hidden" name="order_id" 
                                    value="{{$order->id}}">
                                    <select name="order_status" id="order_status" onchange="this.form.submit()" >
                                        <option 
                                    @if ($order->order_status=='Pending') selected @endif
                                    @if ($order->order_status=='Confirmed') disabled @endif
                                    @if ($order->order_status=='Processing') disabled @endif
                                    @if ($order->order_status=='Delivered') disabled @endif
                                    @if ($order->order_status=='Successed') disabled @endif
                                    @if ($order->order_status=='Canceled') disabled @endif
                                        value="Pending">Pending</option>
                                        <option 
                                    @if ($order->order_status=='Confirmed') selected @endif
                                    @if ($order->order_status=='Processing') disabled @endif
                                    @if ($order->order_status=='Delivered') disabled @endif
                                    @if ($order->order_status=='Successed') disabled @endif
                                    @if ($order->order_status=='Canceled') disabled @endif
                                        value="Confirmed">Confirmed</option>
                                        <option 
                                    @if ($order->order_status=='Processing') selected @endif
                                    @if ($order->order_status=='Delivered') disabled @endif
                                    @if ($order->order_status=='Successed') disabled @endif
                                    @if ($order->order_status=='Canceled') disabled @endif
                                        value="Processing">Processing</option>
                                        <option 
                                    @if ($order->order_status=='Delivered') selected @endif
                                    @if ($order->order_status=='Successed') disabled @endif
                                    @if ($order->order_status=='Canceled') disabled @endif
                                        value="Delivered">Delivered</option>
                                        <option 
                                    @if ($order->order_status=='Successed') selected @endif
                                    @if ($order->order_status=='Canceled') disabled @endif
                                        value="Successed">Successed</option>
                                        <option 
                                    @if ($order->order_status=='Canceled') selected @endif
                                    @if ($order->order_status=='Delivered') disabled @endif
                                    @if ($order->order_status=='Successed') disabled @endif
                                        value="Canceled">Canceled</option>
                                    </select>
                            </form>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{ route('admin.order_view',$order->id) }}" class="cencel_btn btn btn-info btn-xs" > View details </a>
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
                <!-- #END# Exportable Table -->
            </div>
        </div>
    </div>
    
@endsection

@push('js')

@endpush