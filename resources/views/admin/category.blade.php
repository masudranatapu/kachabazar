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
                        <span>Register {{$title}}</span></button>
                      <!-- Create Modal -->
                      <div class="modal fade" id="create" role="dialog">
                        <div class="modal-dialog">

                          <!--Edit Modal content-->
                          <div class="modal-content">
                           <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                               @csrf

                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Register {{$title}} </h4>
                            </div>
                            <div class="modal-body">

                              <div class="form-group row">
                                  <div class="col-xs-3">
                                    <label for="name">Parent Category</label>
                                  </div>
                                  <div class="col-xs-9">
                                      <select name="parent_id" class="form-control">
                                        <option value="">--None--</option>
                                        @foreach ($parents as $c_category)
                                          <option value="{{$c_category->id}}">{{$c_category->name}}</option>
                                        @endforeach
                                      </select>
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <div class="col-xs-3">
                                    <label for="name">Name <i class="text-danger">*</i></label>
                                  </div>
                                  <div class="col-xs-9">
                                      <input type="text" required class="form-control" name="name" value=""  placeholder="Max 100 word.">
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
                                  <div class="col-xs-3">
                                    <label for="name">Slug <i class="text-danger">*</i></label>
                                  </div>
                                  <div class="col-xs-9">
                                      <input type="text" required class="form-control" name="slug" value=""  placeholder="Max 100 word.">
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <div class="col-xs-3">
                                    <label for="name">Image <i class="text-danger">*</i></label>
                                  </div>
                                  <div class="col-xs-9">
                                      <input type="file" name="image">
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <div class="col-xs-3">
                                    <label for="name">Order <i class="text-danger">*</i></label>
                                  </div>
                                  <div class="col-xs-9">
                                      <input type="number" required class="form-control" name="order" value=""  placeholder="Max 11 word.">
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <div class="col-xs-3">
                                    <label for="name">Check</label>
                                  </div>
                                  <div class="col-xs-9">
                                      <input type="checkbox" name="menu" value="1">
                                      <label> Menu</label><br>
                                      <input type="checkbox" name="feature" value="1">
                                      <label> Feature</label><br>

                                      <br>
                                      <input type="checkbox" name="home" value="1">
                                      <label> Home</label><br>
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
                                            <span class="badge bg-blue">{{ $categorys->count() }}</span>
                                        </h3>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="text-right cutom_search" >
                                           <form action="{{ route('admin.category_search') }}" method="get">
                                             <input name="search" type="text" id="search" placeholder="Name" title="Product code." value="{{$search}}">
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
                                            <th width="10%">Image</th>
                                            <th width="10%">Serial</th>
                                            <th width="30%">Name</th>
                                            <th width="30%">ENG</th>
                                            <th width="5%">Menu</th>
                                            <th width="5%">Feature</th>
                                            <th width="5%">Home</th>
                                            <th width="6%">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($categorys as $key=>$category)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>
                                                        <img class="img-responsive" width="30px" height="30px" style="border-radius: 100%;" src="
                                                            @if ($category->image=='default.png')
                                                                {{ asset('images/default.png') }}
                                                            @else
                                                                {{ URL::to($category->image) }}
                                                            @endif
                                                            " alt="">
                                                    </td>
                                                    <td>{{ $category->order }}</td>
                                                    <td>{{ $category->name }}</td>
                                                    <td>{{ $category->eng }}</td>
                                                    <td>{{ $category->menu }}</td>
                                                    <td>{{ $category->feature }}</td>
                                                    <td>{{ $category->home }}</td>
                                                    <td class="text-center">
                                                        <!-- Trigger the edit modal with a button -->
                                                          <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#edit_{{$key}}"><i class="fa fa-pencil"></i></button>
                                                    </td>
                                                </tr>

                                  <!-- edit Modal -->
                                  <div class="modal fade" id="edit_{{$key}}" role="dialog">
                                    <div class="modal-dialog">

                                      <!--Edit Modal content-->
                                      <div class="modal-content">
                                       <form action="{{ route('admin.category.update',$category->id) }}" method="POST" enctype="multipart/form-data" >
                                          @csrf
                                          @method('PUT')

                                        <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                          <h4 class="modal-title">Update {{$title}} </h4>
                                        </div>
                                        <div class="modal-body">

                                          <div class="form-group row">
                                              <div class="col-xs-3">
                                                <label for="name">Parent Category</label>
                                              </div>
                                              <div class="col-xs-9">
                                                  <select name="parent_id" class="form-control">
                                                    <option value="">--None--</option>
                                                    @foreach ($parents as $u_category)
                                                      <option @if ($u_category->id==$category->parent_id)
                                                        selected
                                                      @endif value="{{$u_category->id}}">{{$u_category->name}}</option>
                                                    @endforeach
                                                  </select>
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <div class="col-xs-3">
                                                <label for="name">Name <i class="text-danger">*</i></label>
                                              </div>
                                              <div class="col-xs-9">
                                                  <input type="text" required class="form-control" name="name" value="{{ $category->name }}"  placeholder="Max 100 word.">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <div class="col-xs-3">
                                                <label for="name">Eng</label>
                                              </div>
                                              <div class="col-xs-9">
                                                  <input type="text" class="form-control" name="eng" value="{{ $category->eng }}"  placeholder="Max 200 word.">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <div class="col-xs-3">
                                                <label for="name">Slug <i class="text-danger">*</i></label>
                                              </div>
                                              <div class="col-xs-9">
                                                  <input type="text" required class="form-control" name="slug" value="{{ $category->slug }}"  placeholder="Max 100 word.">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <div class="col-xs-3">
                                                <label for="name">Image <i class="text-danger">*</i></label>
                                              </div>
                                              <div class="col-xs-9">
                                                  <img class="img-responsive" width="100px" height="100px" style="border-radius: 5px;" src="{{ Storage::disk('public')->url('category/'.$category->image) }}" alt="">
                                                  <input type="file" name="image">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <div class="col-xs-3">
                                                <label for="name">Order <i class="text-danger">*</i></label>
                                              </div>
                                              <div class="col-xs-9">
                                                  <input type="number" required class="form-control" name="order" value="{{ $category->order }}"  placeholder="Max 11 word.">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <div class="col-xs-3">
                                                <label for="name">Check</label>
                                              </div>
                                              <div class="col-xs-9">
                                                  <input @if ($category->menu==1) checked @endif type="checkbox" name="menu" value="1">
                                                  <label> Menu</label><br>
                                                  <input @if ($category->feature==1) checked @endif type="checkbox" name="feature" value="1">
                                                  <label> Feature</label><br>

                                                  <br>
                                                  <input @if ($category->home==1) checked @endif type="checkbox" name="home" value="1">
                                                  <label> Home</label><br>
                                              </div>
                                          </div>

                                        </div>
                                        <div class="modal-footer">
                                              <button type="submit" class="btn btn-primary m-t-15 waves-effect">UPDATE</button>

                                        </div>
                                      </form>
                                      </div>

                                    </div>
                                  </div> {{-- model end --}}

                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{$categorys->onEachSide(2)->links()}}
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
