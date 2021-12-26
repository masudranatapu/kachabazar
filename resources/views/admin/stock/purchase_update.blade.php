@extends('layouts.backend.app')

@section('title','Update purchase')

@push('css')
 
@endpush

@section('content')
  <div class="clearfix">
    <div class="box  lm_form table-responsive">
      <div class="box-header with-border ">
        <i class="fa fa-plus-circle"></i>
        <span>Update purchase</span>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form action="{{ route('admin.purchase.update',$purchase->id) }}" method="POST" >
          @csrf
          @method('PUT')
        <div class="form-group row">
            <div class="col-xs-3">
              <label for="name">Product Code. <i class="text-danger">*</i></label>
            </div>
            <div class="col-xs-9">
                <div class="input-group">
                    <input type="text" required class="form-control" name="code" id="code" placeholder="Product Code." value="{{ $purchase->product_code }}">
                    <div class="input-group-addon" style="cursor: pointer;" id="code_to_product"><i class="fa fa-search"></i></div>
                </div>
            </div>
        </div>

        <div id="user_info"></div>

        <div class="form-group row">
            <div class="col-xs-3">
              <label for="name">Quantity <i class="text-danger">*</i></label>
            </div>
            <div class="col-xs-9">
                <input type="number" class="form-control" name="quantity" value="{{ $purchase->quantity }}"  placeholder="Max 12 word.">
            </div>
        </div>
        <!-- /.box-body -->

        <div class="form-group row">
            <div class="col-sm-6">
                <div class="ui buttons">
                    <button type="submit" class="btn btn-success m-t-15 waves-effect">UPDATE</button>

                </div>
            </div>
        </div>
      </form>
    </div>
  </div>
    

@endsection

@push('js')
<script>
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
  // for user to tax ajax load
  $("#code_to_product").click(function() {
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