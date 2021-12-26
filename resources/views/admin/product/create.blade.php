@extends('layouts.backend.app')

@section('title','Add product')

@push('css')

@endpush

@section('content')
    <div class="clearfix">
        <br>
        <div class="row col-xs-12">
            <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-md-6">
                    <div class="multi_form">
                        <div>
                        <h4>
                            <i class="fa fa-plus-circle"></i>
                            <span>Product Info</span>
                        </h4>
                        <hr>
                        </div>

                        <div class="form-group row">
                            <label for="title" class="col-xs-3 col-form-label">Title <i class="text-danger">*</i></label>
                            <div class="col-xs-9">
                                <input name="title" type="text" required class="form-control" id="name" placeholder="Max 150 word." value="" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-xs-3">
                            <label for="name">Eng</label>
                            </div>
                            <div class="col-xs-9">
                                <input type="text" class="form-control" name="eng" value=""  placeholder="Max 200 word.">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="title" class="col-xs-3 col-form-label">Slug <i class="text-danger">*</i></label>
                            <div class="col-xs-9">
                                <input name="slug" type="text" required class="form-control" id="name" placeholder="Max 150 word & must be unique." value="" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Regular price" class="col-xs-3 col-form-label">Regular price</label>
                            <div class="col-xs-9">
                                <input name="regular_price" type="text" class="form-control" id="regular_price" placeholder="Only number" value="" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="firstname" class="col-xs-3 col-form-label">Discount <i class="text-danger">*</i></label>
                            <div class="col-xs-9">
                                <div class="input-group">
                                    <input class="form-control" id="discount" type="text" pattern="[0-9]*\.?[0-9]*" title="Numbers only and dot" name="discount" value="0" required >
                                    <div class="input-group-addon">%</div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Sell price" class="col-xs-3 col-form-label">Sell price <i class="text-danger">*</i></label>
                            <div class="col-xs-9">
                                <input name="sell_price" required type="text" class="form-control" id="sell_price" placeholder="Only number" value="" >
                            </div>
                        </div>

                        {{-- <div class="form-group row">
                            <label for="Size" class="col-xs-3 col-form-label">Unit</label>
                            <div class="col-xs-9">
                                <select name="unit_id" data-placeholder="Select Size" class="form-control select2" style="width: 100%;" >
                                    <option value="">Select One</option>
                                    @foreach($unit as $key=>$unit)
                                        <option value="{{$unit->id}} ">{{$unit->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}

                        <div class="form-group row">
                            <label for="Photo" class="col-xs-3 col-form-label">Cover Photo (800x800px)</label>
                            <div class="col-xs-9">
                                <input type="file" class="form-control" name="cover_photo" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Long description" class="col-xs-3 col-form-label">About Product </label>
                            <div class="col-xs-9">
                                <textarea id="long_description" name="long_description" rows="7" class="form-control" placeholder="About Product"></textarea>
                            </div>
                        </div>

                    </div>
                    <br>

                </div>
                <div class="col-md-6 ">
                    {{-- for category --}}
                    <div class="multi_form">
                    <div>
                        <h4>
                        <i class="fa fa-plus-circle"></i>
                        <span>More Info</span>
                        </h4>
                        <hr>
                    </div>

                    <div class="form-group row">
                        <label for="Size" class="col-xs-3 col-form-label">Category <i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <select name="category_id" required class="form-control select2" style="width: 100%;" >
                                <option value="">Select One</option>

                                @foreach($categorys as $key=>$category)
                                    <option value="{{$category->id}} ">{{$category->name}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="Photo" class="col-xs-3 col-form-label">Others Photo (800x800px)</label>
                        <div class="col-xs-9">
                            <input type="file" class="form-control" name="others_photo[]" multiple >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="Product type" class="col-xs-3 col-form-label">Product type <i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <select name="product_type" class="form-control" required style="width: 100%;" >
                                <option value="Best Selling">Best Selling</option>
                                <option value="Feature">Feature</option>
                                <option value="New Arrival">New Arrival</option>
                                <option value="Popular Product">Popular Product</option>
                                <option value="Tranding">Tranding</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3">Availability <i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <div class="form-check">
                                <label class="radio-inline">
                                <input type="radio" name="availability" value="In stock"  checked="checked" >Instock </label>
                                <label class="radio-inline">
                                <input type="radio" name="availability" value="Out of stock"  >Out of stock</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3">Status <i class="text-danger">*</i></label>
                        <div class="col-xs-9">
                            <div class="form-check">
                                <label class="radio-inline">
                                <input type="radio" name="status" value="Active"  checked="checked" >Active</label>
                                <label class="radio-inline">
                                <input type="radio" name="status" value="Inactive"  >Inactive</label>
                            </div>
                        </div>
                    </div>

                    </div><br>

                    {{-- for meta description --}}
                    <div class="multi_form">
                    <div>
                        <h4>
                        <i class="fa fa-plus-circle"></i>
                        <span>For S.E.O</span>
                        </h4>
                        <hr>
                    </div>

                    <div class="form-group row">
                        <label for="Meta description" class="col-xs-3 col-form-label">Meta description </label>
                        <div class="col-xs-9">
                            <textarea id="meta_description" name="meta_description" rows="5" class="form-control" placeholder="Meta description"></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="Meta description" class="col-xs-3 col-form-label">Meta Keyword </label>
                        <div class="col-xs-9">
                            <textarea id="meta_keyword" name="meta_keyword" rows="3" class="form-control" placeholder="Meta Keyword"></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-offset-3 col-sm-6">
                            <div class="ui buttons">
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>
                            </div>
                        </div>
                    </div>


                    </div>
                    <br>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      // Enable sidebar push menu
      if ($("body").hasClass('sidebar-collapse')) {
          $("body").removeClass('sidebar-collapse').trigger('expanded.pushMenu');
      } else {
          $("body").addClass('sidebar-collapse').trigger('collapsed.pushMenu');
      }
      //Initialize Select2 Elements
      $('.select2').select2()
      // ck editor
      CKEDITOR.replace('long_description')

    });
  </script>
  <!-- CK Editor -->
  <script src="{{asset('assets/backend/plugins/ckeditor/ckeditor.js')}}"></script>
  <script src="{{ asset('js/discount.js') }}"></script>
@endpush
