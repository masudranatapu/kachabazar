@extends('layouts.backend.app')

@section('title')
  {{$title}}
@stop

@push('css')

@endpush

@section('content')
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">{{$title}}</li>
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
                                            <strong>Product</strong>
                                            <span class="badge bg-blue">{{ $solds->count() }}</span>
                                        </h3>
                                    </div>
                                    <div class="col-lg-7 col-md-7 col-sm-7">
                                        <div class="text-right cutom_search" >
                                            <form action="{{ route('admin.sold_search') }}" method="get">
                                              <input type="date" name="from" id="" value="{{$from}}">
                                              To
                                              <input type="date" name="to" id="" value="{{$to}}">
                                              <input name="search" type="text" id="search" placeholder="Product code / Order code / Title" title="Product code." value="{{$search}}">
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
                                            <th width="30%">Title</th>
                                            <th width="10%">Order code</th>
                                            <th width="7%">Quantity</th>
                                            <th width="8%">Create</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($solds as $key=>$sold)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $sold->product_code }}</td>
                                                    <td>{{ str_limit($sold->title,34) }}</td>
                                                    <td>{{ $sold->order_code }}</td>
                                                    <td>{{ $sold->quantity }}</td>
                                                    <td>{{ $sold->created_at->format('d-m-Y') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{$solds->onEachSide(2)->links()}}
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
