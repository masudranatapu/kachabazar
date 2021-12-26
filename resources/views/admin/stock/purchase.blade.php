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
                <div class="block-header ">
                      <!-- Trigger the Create modal with a button -->
                      <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#create"><i class="fa fa-plus-circle"></i>
                        <span>{{$title}}</span></button>

                      <!-- Create Modal -->
                      <div class="modal fade" id="create" role="dialog">
                        <div class="modal-dialog">

                          <!--Edit Modal content-->
                          <div class="modal-content">
                           <form action="{{ route('admin.purchase.store') }}" method="POST">
                               @csrf

                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">{{$title}} </h4>
                            </div>
                            <div class="modal-body">

                              <div class="form-group row">
                                  <div class="col-xs-3">
                                    <label for="name">Product Code. <i class="text-danger">*</i></label>
                                  </div>
                                  <div class="col-xs-9">
                                    <select name="code" id="code" class="form-control">
                                      <option value="" disabled=""  selected ="">Select Product </option>
                                      @foreach($products as $product)
                                        <option value="{{$product->product_code}}"> {{$product->title}} - {{$product->product_code}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                              </div>

                              <div id="user_info"></div>

                              <div class="form-group row">
                                  <div class="col-xs-3">
                                    <label for="name">Quantity <i class="text-danger">*</i></label>
                                  </div>
                                  <div class="col-xs-9">
                                      <input type="number" class="form-control" name="quantity" value=""  placeholder="Max 12 word.">
                                  </div>
                              </div>

                            </div>
                            <div class="modal-footer">
                                  <button type="submit" class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>

                            </div>
                          </form>
                          </div>

                        </div>
                      </div> {{-- model end --}}

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
                                            <span class="badge bg-blue">{{ $purchases->count() }}</span>
                                        </h3>
                                    </div>
                                    <div class="col-lg-7 col-md-7 col-sm-7">
                                        <div class="text-right cutom_search" >
                                            <form action="{{ route('admin.purchase_search') }}" method="get">
                                              <input type="date" name="from" id="" value="{{$from}}">
                                              To
                                              <input type="date" name="to" id="" value="{{$to}}">
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
                                            <th width="30%">Title</th>
                                            <th width="7%">Quantity</th>
                                            <th width="8%">Create</th>
                                            <th width="6%">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($purchases as $key=>$purchase)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $purchase->product_code }}</td>
                                                    <td>{{ str_limit($purchase->title,34) }}</td>
                                                    <td>{{ $purchase->quantity }}</td>
                                                    <td>{{ $purchase->created_at->format('d-m-Y') }}</td>

                                                    <td class="text-center">
                                                        <a href="{{ route('admin.purchase.edit',$purchase->id) }}" class=" waves-effect btn btn-warning btn-xs" target="blank">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{$purchases->onEachSide(2)->links()}}
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
  // for user to tax ajax load
  $("#code").click(function() {
    var product_code = $("#code").val();
    $.ajax({
      type:"POST",
      url:"{{ route('admin.product_code_ajax_book') }}",
      data:{
            product_code: product_code,
            _token: '{{csrf_token()}}'
          },
      success:function(data) {
          $("#user_info").html(data);
          // console.log(data);
      }
    });
  }); /*end ajax*/
</script>
@endpush