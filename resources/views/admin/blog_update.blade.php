@extends('layouts.backend.app')

@section('title','Update blog')

@push('css')
 
@endpush

@section('content')
  <div class="clearfix">
    <div class="box  lm_form table-responsive">
      <div class="box-header with-border ">
        <i class="fa fa-plus-circle"></i>
        <span>Update blog</span>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form action="{{ route('admin.blog.update',$blog->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group row">
            <div class="col-xs-3">
              <label for="name">Title <i class="text-danger">*</i></label>
            </div>
            <div class="col-xs-9">
                <input type="text" required class="form-control" name="title" value="{{ $blog->title }}"  placeholder="Max 100 word.">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-xs-3">
              <label for="name">Slug <i class="text-danger">*</i></label>
            </div>
            <div class="col-xs-9">
                <input type="text" required class="form-control" name="slug" value="{{ $blog->slug }}"  placeholder="Max 100 word.">
            </div>
        </div>

        <div class="form-group row">
            <label for="Photo" class="col-xs-3 col-form-label">Photo (700x800px) <i class="text-danger">*</i></label>
            <div class="col-xs-9">
                <img src="{{ Storage::disk('public')->url('blog/'.$blog->cover_photo) }}" class="img-responsive" style="height: 100;width: 80px; margin-bottom: 3px;" alt="">

                <input type="file" name="cover_photo"  >
            </div>
        </div>

        <div class="form-group row">
            <div class="col-xs-3">
              <label for="name">Short Description</label>
            </div>
            <div class="col-xs-9">
                <textarea name="short_description" id="short_description" class="form-control" rows="5" maxlength="1000">{{ $blog->short_description }}</textarea>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-xs-3">
              <label for="name">Description</label>
            </div>
            <div class="col-xs-9">
                <textarea name="description" id="description" class="form-control" rows="10">{{ $blog->description }}</textarea>
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
    jQuery(document).ready(function($) {
      CKEDITOR.replace('description')
    });
  </script>
  <!-- CK Editor -->
  <script src="{{asset('assets/backend/plugins/ckeditor/ckeditor.js')}}"></script>
@endpush 