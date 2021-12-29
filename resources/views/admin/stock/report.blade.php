@extends('layouts.backend.app')

@section('title','Stock Report')

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
        <li class="active">Stock Report</li>
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
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-sm-5">
                                        <h3>
                                            <strong>Stock Report</strong>
                                            <span class="badge bg-blue">{{ $products->count() }}</span>
                                        </h3>
                                    </div>
                                    <div class="col-lg-7 col-md-7 col-sm-7">
                                        <div class="text-right cutom_search" >
                                            <form action="{{ route('admin.stock_search') }}" method="get">
                                              <input name="search" type="text" id="search" placeholder="Product code / Title" title="Product code." value="{{$search}}">
                                              <button type="submit"><i class="fa fa-search"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                        <thead>
                                        <tr>
                                            <th width="5%">SL</th>
                                            <th width="10%">Product code</th>
                                            <th width="60%">Title</th>
                                            <th width="10%">In Stock</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($products as $key=>$product)
                                                @php
                                                    $purchase = App\Purchase::where('product_id',$product->id)->sum('quantity');
                                                    $sold = App\Sold::where('product_id',$product->id)->sum('quantity');
                                                    $stock = $purchase-$sold;
                                                @endphp

                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $product->product_code }}</td>
                                                    <td>{{ str_limit($product->title,44) }}</td>
                                                    <td>{{ $stock }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{$products->onEachSide(2)->links()}}
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