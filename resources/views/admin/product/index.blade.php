@extends('layouts.backend.app')

@section('title','Product')

@push('css')

@endpush

@section('content')
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="{{ route('login') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Product</li>
      </ol>
    </section>

    <div class="clearfix">
        <div class="pro_back">
            <div class="container-fluid d_table">
                <div class="block-header ">
                    <a class="btn btn-primary btn-xs waves-effect" target="blank" href="{{ route('admin.product.create') }}">
                        <i class="fa fa-plus-circle"></i>
                        <span>Add Product</span>
                    </a>
                </div>
                <!-- Exportable Table -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-sm-5">
                                        <h3>
                                            <strong>Product</strong>
                                            <span class="badge bg-blue">{{ $products->count() }}</span>
                                        </h3>
                                    </div>
                                    <div class="col-lg-7 col-md-7 col-sm-7">
                                        <div class="text-right cutom_search" >
                                            <form action="{{ route('admin.product_search') }}" method="get">
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
                                            <th width="4%">SL</th>
                                            <th width="9%">Image</th>
                                            <th width="9%">Product code</th>
                                            <th width="18%">Title</th>
                                            <th width="7%">Sell price</th>
                                            <th width="7%">Regular price</th>
                                            <th width="4%">Off</th>
                                            <th width="5%">Availability</th>
                                            <th width="5%">Status</th>
                                            <th width="12%">Upload By</th>
                                            <th width="8%">Create</th>
                                            <th width="6%">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($products as $key=>$product)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>
                                                        <img class="img-responsive" width="60px" height="50px" style="border-radius: 100%;" src="{{ URL::to($product->cover_photo) }} " alt="">
                                                    </td>
                                                    <td>{{ $product->product_code }}</td>
                                                    <td>{{ str_limit($product->title,30) }}</td>
                                                    <td>৳ {{ $product->sell_price }}</td>
                                                    <td>৳ {{ $product->regular_price }}</td>
                                                    <td>{{ $product->discount }}%</td>
                                                    <td>{{ $product->availability }}</td>
                                                    <td>{{ $product->status }}</td>
                                                    <td>{{ $product->User->name }}</td>
                                                    <td>{{ $product->created_at->format('d-m-Y') }}</td>

                                                    <td class="text-center">
                                                        <a href="{{ route('admin.product.edit',$product->id) }}" class=" waves-effect btn btn-warning btn-xs" target="blank">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                    </td>
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
<script>
    if ($("body").hasClass('sidebar-collapse')) {
        $("body").removeClass('sidebar-collapse').trigger('expanded.pushMenu');
    } else {
        $("body").addClass('sidebar-collapse').trigger('collapsed.pushMenu');
    }
</script>
@endpush
