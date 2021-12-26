@extends('layouts.backend.app')

@section('title')
    {{$title}}
@endsection

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
                      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#create"><i class="fa fa-plus-circle"></i>
                        <span>Create {{$title}}</span></button>

                      <!-- Create Modal -->
                      <div class="modal fade" id="create" role="dialog">
                        <div class="modal-dialog">
                        
                          <!--Edit Modal content-->
                          <div class="modal-content">
                           <form action="{{ route('admin.district.store') }}" method="POST" >
                               @csrf

                            <div class="modal-header">                                
                              <h4 class="modal-title">District </h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                              <div class="form-group row">
                                  <label class="col-form-label col-sm-3 text-sm-right">Name</label>
                                  <div class="col-sm-9">
                                      <input required type="text" name="name" placeholder="district name" class="form-control">
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <label class="col-form-label col-sm-3 text-sm-right">Division</label>
                                  <div class="col-sm-9">
                                      <select required name="division_id" id="division_id" class="custom-select custom-select-lg">
                                          <option value="">Select One</option>
                                          @foreach ($cr_division as $division)
                                            <option value="{{$division->id}}">{{$division->name}} </option>
                                          @endforeach

                                      </select>
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

                </div>
                <!-- Exportable Table -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    <strong>District</strong>
                                    <span class="badge bg-blue">{{ $districts->count() }}</span>
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
                                                <th>division</th>
                                                <th class="text-center">Action </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($districts as $key=>$district)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$district->name}}</td>
                                                    <td>{{$district->slug}}</td>
                                                    <td>{{$district->Division->name}}</td>
                                                    <td class="text-center">
                                                        <a class="btn btn-md btn-primary" data-toggle="modal" data-target="#edit_{{$key}}"><i class="far fa-edit"></i> Edit</a>
                                                    </td>
                                                    
                                                </tr>

                                                <!-- Edit Modal -->
                                                <div class="modal fade" id="edit_{{$key}}" role="dialog">
                                                  <div class="modal-dialog">
                                                  
                                                    <!--Edit Modal content-->
                                                    <div class="modal-content">
                                                     <form action="{{ route('admin.district.update',$district->id) }}" method="POST"  >
                                                        @csrf
                                                        @method('PUT')

                                                      <div class="modal-header">                                
                                                        <h4 class="modal-title">district </h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                      </div>
                                                      <div class="modal-body">
                                                        <div class="form-group row">
                                                            <label class="col-form-label col-sm-3 text-sm-right">Name</label>
                                                            <div class="col-sm-9">
                                                                <input required type="text" name="name" value="{{$district->name}}" placeholder="district name" class="form-control">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-form-label col-sm-3 text-sm-right">Division</label>
                                                            <div class="col-sm-9">
                                                                <select required name="division_id" id="division_id" class="custom-select custom-select-lg">
                                                                    <option value="">Select One</option>
                                                                    @foreach ($ed_division as $division)
                                                                      <option @if ($division->id==$district->division_id)
                                                                        selected 
                                                                      @endif value="{{$division->id}}">{{$division->name}} </option>
                                                                    @endforeach

                                                                </select>
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
                                    {{$districts->onEachSide(2)->links()}}
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