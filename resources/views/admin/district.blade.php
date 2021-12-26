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
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#create"><i class="fa fa-plus-circle"></i>
                        <span>Create {{$title}}</span>
                    </button>
                    <div class="modal fade" id="create" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('admin.district.store') }}" method="POST" >
                                    @csrf
                                        <div class="modal-header">                                
                                        <h4 class="modal-title">District </h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group row">
                                                <label class="col-form-label col-sm-3 text-sm-right">Division</label>
                                                <div class="col-sm-9">
                                                    <select required name="division_id" id="division_id" class="custom-select custom-select-lg form-control">
                                                        <option value="" disabled>Select One</option>
                                                        @foreach ($cr_division as $division)
                                                        <option value="{{$division->id}}">{{$division->name}} </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label col-sm-3 text-sm-right">Name</label>
                                                <div class="col-sm-9">
                                                    <input required type="text" name="name" placeholder="district name" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label col-sm-3 text-sm-right">Price</label>
                                                <div class="col-sm-9">
                                                    <input required type="text" name="price" placeholder="Price" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label col-sm-3 text-sm-right">Day</label>
                                                <div class="col-sm-9">
                                                    <select required name="day" class="custom-select custom-select-lg form-control">
                                                        <option value="" disabled>Select One</option>
                                                        <option value="Monday">Monday</option>
                                                        <option value="Tuesday">Tuesday</option>
                                                        <option value="Wednesday">Wednesday</option>
                                                        <option value="Thursday">Thursday</option>
                                                        <option value="Friday">Friday</option>
                                                        <option value="Saturday">Saturday</option>
                                                        <option value="Sunday">Sunday</option>
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
                </div>
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
                                                <th>division</th>
                                                <th>Price</th>
                                                <th>Day</th>
                                                <th class="text-center">Action </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($districts as $key=>$district)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$district->name}}</td>
                                                    <td>{{$district->Division->name}}</td>
                                                    <td>{{$district->price}} TK</td>
                                                    <td>{{$district->day}}</td>
                                                    <td class="text-center">
                                                        <a class="btn btn-md btn-primary" data-toggle="modal" data-target="#edit_{{$key}}"><i class="far fa-edit"></i> Edit</a>
                                                    </td>
                                                </tr>
                                                <div class="modal fade" id="edit_{{$key}}" role="dialog">
                                                    <div class="modal-dialog">
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
                                                                        <label class="col-form-label col-sm-3 text-sm-right">Division</label>
                                                                        <div class="col-sm-9">
                                                                            <select required name="division_id" id="division_id" class="custom-select custom-select-lg form-control">
                                                                                <option value="">Select One</option>
                                                                                @foreach ($ed_division as $division)
                                                                                    <option @if ($division->id==$district->division_id) selected @endif value="{{$division->id}}">{{$division->name}} </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label class="col-form-label col-sm-3 text-sm-right">Name</label>
                                                                        <div class="col-sm-9">
                                                                            <input required type="text" name="name" value="{{$district->name}}" placeholder="district name" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label class="col-form-label col-sm-3 text-sm-right">Price</label>
                                                                        <div class="col-sm-9">
                                                                            <input required type="text" name="price" value="{{$district->price}}" placeholder="Price" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label class="col-form-label col-sm-3 text-sm-right">Day</label>
                                                                        <div class="col-sm-9">
                                                                            <select required name="day" class="custom-select custom-select-lg form-control">
                                                                                <option value="" disabled>Select One</option>
                                                                                <option @if($district->day == "Monday") selected @endif value="Monday">Monday</option>
                                                                                <option @if($district->day == "Tuesday") selected @endif value="Tuesday">Tuesday</option>
                                                                                <option @if($district->day == "Wednesday") selected @endif value="Wednesday">Wednesday</option>
                                                                                <option @if($district->day == "Thursday") selected @endif value="Thursday">Thursday</option>
                                                                                <option @if($district->day == "Friday") selected @endif value="Friday">Friday</option>
                                                                                <option @if($district->day == "Saturday") selected @endif value="Saturday">Saturday</option>
                                                                                <option @if($district->day == "Sunday") selected @endif value="Sunday">Sunday</option>
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
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{$districts->onEachSide(2)->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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