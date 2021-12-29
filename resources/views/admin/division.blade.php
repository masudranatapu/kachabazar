@extends('layouts.backend.app')

@section('title','Division')

@push('css')

@endpush

@section('content')
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Division</li>
      </ol>
    </section>

    <div class="clearfix">
        <div class="pro_back">
            <div class="container-fluid d_table">
                <div class="block-header ">

                    <!-- Trigger the Create modal with a button -->
                      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#create"><i class="fa fa-plus-circle"></i>
                        <span>Create Division</span></button>

                      <!-- Create Modal -->
                      <div class="modal fade" id="create" role="dialog">
                        <div class="modal-dialog">
                        
                          <!--Create Modal content-->
                          <div class="modal-content">
                           <form action="{{ route('admin.division.store') }}" method="POST" >
                               @csrf

                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Create division </h4>
                            </div>
                            <div class="modal-body">
                              <div class="form-group row">
                                  <label class="col-form-label col-sm-2 text-sm-right">Name</label>
                                  <div class="col-sm-10">
                                      <input required type="text" name="name" placeholder="Division name" class="form-control">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label class="col-form-label col-sm-2 text-sm-right">Price</label>
                                  <div class="col-sm-10">
                                      <input required type="text" name="charge" placeholder="charge" class="form-control">
                                  </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                                  <button type="submit" class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>
                                                                                            
                            </div>
                          </form>
                          </div>
                        </div>
                      </div>
                </div>
                <!-- Exportable Table -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    <strong>Division list</strong>
                                    <span class="badge bg-blue">{{ $divisions->count() }}</span>
                                </h2>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Name</th>
                                                <th>Slug</th>
                                                <th>Price</th>
                                                <th class="text-center">Action </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($divisions as $key=>$division)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$division->name}}</td>
                                                    <td>{{$division->slug}}</td>
                                                    <td>{{$division->charge}} TK </td>
                                                    <td class="text-center">
                                                        <a class="btn btn-xs btn-warning" data-toggle="modal" data-target="#edit_{{$key}}"><i class="fa fa-edit"></i> Edit</a>
                                                    </td>
                                                </tr>
                                                <div class="modal fade" id="edit_{{$key}}" role="dialog">
                                                  <div class="modal-dialog">
                                                  
                                                    <!--Edit Modal content-->
                                                    <div class="modal-content">
                                                     <form action="{{ route('admin.division.update',$division->id) }}" method="POST"  >
                                                        @csrf
                                                        @method('PUT')

                                                      <div class="modal-header">                                
                                                        <h4 class="modal-title">division </h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                      </div>
                                                      <div class="modal-body">
                                                        <div class="form-group row">
                                                            <label class="col-form-label col-sm-2 text-sm-right">Name</label>
                                                            <div class="col-sm-10">
                                                                <input required type="text" name="name" value="{{$division->name}}" placeholder="division name" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-form-label col-sm-2 text-sm-right">Price</label>
                                                            <div class="col-sm-10">
                                                                <input required type="text" name="charge" value="{{$division->charge}}" placeholder="Price" class="form-control">
                                                            </div>
                                                        </div>
                                                      </div>
                                                      <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>
                                                                                                                      
                                                      </div>
                                                    </form>
                                                    </div>
                                                    
                                                  </div>
                                                </div> 
                                                {{-- model end --}}
                                            @endforeach
                                            

                                        </tbody>

                                    </table>
                                    {{$divisions->onEachSide(2)->links()}}
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
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            //Initialize Select2 Elements
            $('.select2').select2()
        });
    </script>
@endpush