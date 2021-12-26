@extends('layouts.backend.app')

@section('title','Update policy')

@push('css')
 
@endpush

@section('content')
  <div class="clearfix">
    <div class="box  lm_form table-responsive">
      <div class="box-header with-border ">
        <i class="fa fa-plus-circle"></i>
        <span>Update Policy</span>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form action="{{ route('admin.policy.update',$policy->id) }}" method="POST" >
        @csrf
        @method('PUT')
        <div class="form-group row">
            <div class="col-xs-3">
              <label for="name">Name <i class="text-danger">*</i></label>
            </div>
            <div class="col-xs-9">
                <input type="text" required class="form-control" name="name" value="{{ $policy->name }}"  placeholder="Max 100 word.">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-xs-3">
              <label for="name">Slug <i class="text-danger">*</i></label>
            </div>
            <div class="col-xs-9">
                <input type="text" required class="form-control" name="slug" value="{{ $policy->slug }}"  placeholder="Max 100 word.">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-xs-3">
              <label for="name">Description</label>
            </div>
            <div class="col-xs-9">
                <textarea name="description" id="description" class="form-control" rows="10">{{ $policy->description }}</textarea>
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