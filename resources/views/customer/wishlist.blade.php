@extends('layouts.frontend.app')

@section('title')
    {{$title}}
@endsection


@section('meta')

@endsection

@push('css')
    <style>
        .panel_bg {
            background-color: #0D7E40;
            color: white;
        }
    </style>
@endpush

@section('content')
<!--breadcrumbs area start-->
<div class="breadcrumbs_area commun_bread py-3 grey-section">
    <div class="container">   
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <ul class="text-capitalize">
                        <li><a href="{{ route('home') }}">home</a></li>
                        <li><i class="fa fa-angle-right"></i></li>
                        <li>Account Wishlist</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>         
</div>
<!--breadcrumbs area end-->
<section class="pad-tb-25 mt-10">
    <div class="container">
        <div class="row">

            <div class="col-md-3 eng">
             {{-- for coustomer_sidebar --}}
             @include('layouts.frontend.partial.coustomer_sidebar')
            </div>
            <div class="col-md-9">
                <div class="alert panel_bg">
                    <strong>
                        Wishlist ({{$wishlists->count()}})
                    </strong>
                </div>
                <div class="row">
                    <div class="col-md-12">
                      <table class="table table-responsive table-bordered panel_area" style="font-size:14px;background-color:#FFF; width: 100%;">
                          <thead>
                              <tr>
                                  <th>Photo</th>
                                  <th>Title</th>
                                  <th>Price</th>
                                  <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach($wishlists as $key=>$wishlist)
                                  <tr>
                                    <td><img src="{{ Storage::disk('public')->url('product/'.$wishlist->Product->cover_photo) }}" height="75px"></td>
                                    <td style="font-size:16px;">
                                          <strong>{{ $wishlist->Product->title }}</strong><br />
                                      </td>
                                    <td><strong>{{$wishlist->Product->sell_price }}</strong><sup>৳</sup></td>
                                    <td>
                                      {{-- for cart --}}
                                      @if ($wishlist->Product->size_id || $wishlist->Product->colour_id)
                                           <a id="add_cart_required" data-toggle="modal" data-target="#create_{{$key}}_{{$wishlist->Product->id}}" class="btn btn-success btn-xs add-to-cart" title="Cart" >  Add to Cart</a>
                                      @else
                                           <a class="btn btn-success btn-xs add-to-cart" href="{{ route('add_to_cart',$wishlist->Product->id) }}" title="Cart">  Add to Cart</a>
                                      @endif

                                      <button class="btn btn-danger btn-xs" type="button" onclick="deleteData({{ $wishlist->id }})">
                                          <span>Remove</span>
                                      </button>
                                      <form id="delete-form-{{ $wishlist->id }}" action="{{ route('customer.wishlist.destroy',$wishlist->id) }}" method="POST" style="display: none;">
                                          @csrf
                                          @method('DELETE')
                                      </form>
                                    </td>
                                  </tr>

                                  <!-- Create Modal -->
                                  <div class="modal fade" id="create_{{$key}}_{{$wishlist->Product->id}}" role="dialog" >
                                    <div class="modal-dialog">

                                      <!--Edit Modal content-->
                                      <div class="modal-content">
                                       <form action="{{ route('add_to_cart_with_size_color') }}" method="POST" >
                                           @csrf

                                        <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                          <h4>{{$wishlist->Product->title}}</h4>

                                        </div>
                                        <div class="modal-body">
                                          <input type="hidden" name="product_id" value="{{$wishlist->Product->id}}">
                                          @if ($wishlist->Product->size_id)
                                              <div class="form-group row">
                                                <label class="col-sm-3">Size <i class="text-danger">*</i></label>
                                                <div class="col-xs-9">
                                                    <div class="form-check">
                                                        <?php
                                                          $product_size = explode(",",$wishlist->Product->size_id);
                                                        ?>
                                                        @foreach($product_size as $key=>$product_size)
                                                        @php
                                                          $size = App\Size::find($product_size);
                                                        @endphp

                                                            <label class="radio-inline">
                                                            <input type="radio" required name="size_id" value="{{$size->id}}" > {{$size->name}}</label>
                                                        @endforeach
                                                    </div>
                                                </div>
                                              </div>
                                          @endif

                                          @if ($wishlist->Product->colour_id)
                                              <div class="form-group row">
                                                <label class="col-sm-3">Colour <i class="text-danger">*</i></label>
                                                <div class="col-xs-9">
                                                    <div class="form-check">
                                                       <?php
                                                         $product_colour = explode(",",$wishlist->Product->colour_id);
                                                       ?>
                                                       @foreach($product_colour as $key=>$product_colour)
                                                       @php
                                                          $colour = App\Colour::find($product_colour);
                                                       @endphp
                                                           <label class="radio-inline">
                                                           <input type="radio" required name="colour_id" value="{{$colour->id}}" > {{$colour->name}}</label>
                                                       @endforeach
                                                    </div>
                                                </div>
                                              </div>
                                          @endif


                                        </div>
                                        <div class="modal-footer">
                                              <button type="submit" class="btn btn-primary m-t-15 waves-effect">Add to Cart</button>

                                        </div>
                                      </form>
                                      </div>

                                    </div>
                                  </div> {{-- model end --}}
                              @endforeach
                            </tbody>
                        </table>
                        {{$wishlists->onEachSide(2)->links()}}
                        <a href="{{ route('home') }}" class="btn btn-success">Continue Shopping</a>
                    </div>

                </div>


            </div>

        </div>
    </div>
</section>
@endsection

@push('js')
    <script>
        function deleteData(id) {
            if(confirm("Are you sure")) {
                document.getElementById('delete-form-'+id).submit();
            }
        }
    </script>

@endpush
