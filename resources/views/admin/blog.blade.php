@extends('layouts.backend.app')

@section('title')
  {{$title}}
@stop

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
        <li class="active">{{$title}}</li>
      </ol>
    </section>

    <div class="clearfix">
        <div class="pro_back">
            <div class="container-fluid d_table">
                <div class="block-header ">
                      <!-- Create Modal -->
                      <div class="modal fade" id="create" role="dialog">
                        <div class="modal-dialog">
                        
                          <!--Edit Modal content-->
                          <div class="modal-content">
                           <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
                               @csrf

                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Posting {{$title}} </h4>
                            </div>
                            <div class="modal-body">

                              <div class="form-group row">
                                  <div class="col-xs-3">
                                    <label for="name">Title <i class="text-danger">*</i></label>
                                  </div>
                                  <div class="col-xs-9">
                                      <input type="text" required class="form-control" name="title" value=""  placeholder="Max 150 word.">
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <div class="col-xs-3">
                                    <label for="name">Slug <i class="text-danger">*</i></label>
                                  </div>
                                  <div class="col-xs-9">
                                      <input type="text" e class="form-control" name="slug" value=""  placeholder="Max 150 word.">
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <label for="Photo" class="col-xs-3 col-form-label">Photo (700x800px)</label>
                                  <div class="col-xs-9">
                                      <input type="file" name="cover_photo" >
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <div class="col-xs-3">
                                    <label for="name">Short Description</label>
                                  </div>
                                  <div class="col-xs-9">
                                      <textarea name="short_description" id="short_description" class="form-control" rows="5" maxlength="1000"></textarea>
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <div class="col-xs-3">
                                    <label for="name">Description</label>
                                  </div>
                                  <div class="col-xs-9">
                                      <textarea name="description" id="description" class="form-control" rows="5"></textarea>
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
                                    <div class="col-lg-8 col-md-8 col-sm-8">
                                        <h3>
                                            <strong>{{$title}}</strong>
                                            <span class="badge bg-blue">{{ $blogs->count() }}</span>
                                        </h3>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="text-right cutom_search" >
                                           <!-- Trigger the Create modal with a button -->
                                           <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#create"><i class="fa fa-plus-circle"></i>
                                             <span>Posting {{$title}}</span></button>
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
                                            <th width="15%">Image</th>
                                            <th width="20%">Title</th>
                                            <th width="44%">Short Description</th>
                                            <th width="6%">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($blogs as $key=>$blog)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>
                                                      <img style="height: 100px;" src="{{ Storage::disk('public')->url('blog/'.$blog->cover_photo) }}" alt="" class="img-responsive">
                                                    </td>
                                                    <td>{{ $blog->title }}</td>
                                                    <td>{!!str_limit($blog->short_description,135)!!}</td>
                                                    <td class="text-center">
                                                      <a target="_blank" href="{{ route('admin.blog.edit',$blog->id) }}" class=" waves-effect btn btn-warning btn-xs" target="blank">
                                                          <i class="fa fa-pencil"></i>
                                                      </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{$blogs->onEachSide(2)->links()}}
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
    jQuery(document).ready(function($) {
      CKEDITOR.replace('description')
    });
  </script>
  <!-- CK Editor -->
  <script src="{{asset('assets/backend/plugins/ckeditor/ckeditor.js')}}"></script>
@endpush