@extends('layouts.backend.app')

@section('title','Website Information Edit')

@push('css')

@endpush

@section('content')
  <div class="clearfix">
    <div class="box  lm_form table-responsive">
      <div class="box-header with-border ">
        <i class="fa fa-plus-circle"></i>
        <span>Website Information Edit</span>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form action="{{ route('admin.website.update',$website->id) }}" method="POST" enctype="multipart/form-data" >
          @csrf
          @method('PUT')
        <div class="form-group row">
            <label for="title" class="col-xs-3 col-form-label">Application Title <i class="text-danger">*</i></label>
            <div class="col-xs-9">
                <input name="title" type="text" class="form-control" id="title" placeholder="Application Title" value="{{$website->title}}">
            </div>
        </div>

        <div class="form-group row">
            <label for="description" class="col-xs-3 col-form-label">Description</label>
            <div class="col-xs-9">
                <textarea name="description" class="form-control"  placeholder="Description" rows="2">{{$website->description}} </textarea>
            </div>
        </div>

        <div class="form-group row">
            <label for="meta_keyword" class="col-xs-3 col-form-label">Meta Keyword</label>
            <div class="col-xs-9">
                <textarea name="meta_keyword" class="form-control"  placeholder="Meta Keyword" rows="2">{{$website->meta_keyword}}</textarea>
            </div>
        </div>

        <div class="form-group row">
            <label for="meta_tag" class="col-xs-3 col-form-label">Meta Description</label>
            <div class="col-xs-9">
                <textarea name="meta_tag" class="form-control"  placeholder="Meta Description" rows="2">{{$website->meta_tag}}</textarea>
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-xs-3 col-form-label">Email Address <i class="text-danger">*</i></label>
            <div class="col-xs-9">
                <input name="email" type="text" class="form-control" id="email" placeholder="Email Address"  value="{{$website->email}}">
            </div>
        </div>

        <div class="form-group row">
            <label for="address" class="col-xs-3 col-form-label">Address <i class="text-danger">*</i></label>
            <div class="col-xs-9">
                <textarea name="address" class="form-control"  placeholder="Address" rows="2">{{$website->address}}</textarea>
            </div>
        </div>

        <div class="form-group row">
            <label for="phone" class="col-xs-3 col-form-label">Phone No <i class="text-danger">*</i></label>
            <div class="col-xs-9">
                <input name="phone" type="text" class="form-control" id="phone" placeholder="Phone No"  value="{{$website->phone}}" >
            </div>
        </div>


        <!-- if setting favicon is already uploaded -->
        <div class="form-group row">
            <label for="faviconPreview" class="col-xs-3 col-form-label"></label>
            <div class="col-xs-9">
                <img src="{{ URL::to($website->favicon) }}" alt="Favicon" class="img-thumbnail" />
            </div>
        </div>

        <div class="form-group row">
            <label for="favicon" class="col-xs-3 col-form-label">Favicon </label>
            <div class="col-xs-9">
                <input type="file" name="favicon" placeholder="Logo" id="favicon" value="">
            </div>
        </div>



        <!-- if setting logo is already uploaded -->
        <div class="form-group row">
            <label for="logoPreview" class="col-xs-3 col-form-label"></label>
            <div class="col-xs-9">
                <img src="{{ URL::to($website->logo) }}" alt="Logo" class="img-thumbnail" />
            </div>
        </div>

        <div class="form-group row">
            <label for="logo" class="col-xs-3 col-form-label">Logo </label>
            <div class="col-xs-9">
                <input type="file" name="logo"  id="logo" value="">
            </div>
        </div>

        <div class="form-group row">
            <label for="twitter_api" class="col-xs-3 col-form-label">Twitter Api</label>
            <div class="col-xs-9">
                <textarea name="twitter_api" class="form-control"  placeholder="Twitter Api" rows="2">{{$website->twitter_api}}</textarea>
            </div>
        </div>

        <div class="form-group row">
            <label for="google_map" class="col-xs-3 col-form-label">Google Map</label>
            <div class="col-xs-9">
                <textarea name="google_map" class="form-control"  placeholder="Google Map" rows="2">{{$website->google_map}}</textarea>
            </div>
        </div>

        <!-- Additional fild -->
        <table class="table table-striped">
            <thead>
                <tr class="bg-primary">
                    <th>Social icon ( https://fontawesome.com/v4.7.0/icons/ )</th>
                    <th>Link</th>
                    <th width="160" class="text-center">Add / Remove</th>
                </tr>
            </thead>
            <tbody id="diagnosis">
              @php
                  $icon = explode("|",$website->icon);
                  $link = explode("|",$website->link);
              @endphp
              @foreach($icon as $key=>$icon)
                <tr>
                    <td>
                        <input type="text" name="icon[]" autocomplete="off" class="form-control" placeholder="https://fontawesome.com/v4.7.0/icons/" value="{{$icon}}" >
                    </td>

                    <td>
                        <input type="text" name="link[]" class="form-control" placeholder="https://" value="@if(isset($link[$key])){{$link[$key]}}@endif" >
                    </td>
                    <td class="text-center">
                      <div class="btn btn-group">
                        <button type="button" class="btn btn-sm btn-primary DiaAddBtn">+</button>
                        <button type="button" class="btn btn-sm btn-danger DiaRemoveBtn">-</button>
                        </div>
                    </td>
                </tr>
              @endforeach
            </tbody>
        </table>

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
    $(document).ready(function() {
      //#------------------------------------
      //   STARTS OF DIAGNOSIS
      //#------------------------------------
      //add row
      $('body').on('click','.DiaAddBtn' ,function() {
          var itemData = $(this).parent().parent().parent();
          $('#diagnosis').append("<tr>"+itemData.html()+"</tr>");
          $('#diagnosis tr:last-child').find(':input').val('');
      });
      //remove row
      $('body').on('click','.DiaRemoveBtn' ,function() {
          $(this).parent().parent().parent().remove();
      });

    });
  </script>
@endpush


