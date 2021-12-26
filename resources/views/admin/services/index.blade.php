@extends('layouts.backend.app')

@section('title','Services')

@push('css')

@endpush

@section('content')
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Services</li>
      </ol>
    </section>
    <div class="clearfix">
        <div class="pro_back">
            <div class="container-fluid d_table">
                <div class="block-header ">
                    <!-- Create Modal -->
                    <div class="modal fade" id="create" role="dialog">
                        <div class="modal-dialog modal-lg">
                            <!--Add Modal content-->
                            <div class="modal-content">
                                <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data" >
                                @csrf
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Add Services </h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group row">
                                            <label class="col-xs-3 col-form-label">Title</label>
                                            <div class="col-xs-9">
                                                <input type="text" class="form-control" required name="title" placeholder="Title">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-xs-3">
                                                <label for="link">Services Image <i class="text-danger">*</i></label>
                                            </div>
                                            <div class="col-xs-9">
                                                <input type="file" class="form-control" name="image">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-xs-3">
                                                <label for="link">Services Details <i class="text-danger">*</i></label>
                                            </div>
                                            <div class="col-xs-9">
                                                <textarea name="details" id="long_description" cols="30" rows="10" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-xs-3">
                                                <label for="link">Status<i class="text-danger">*</i></label>
                                            </div>
                                            <div class="col-xs-9">
                                                <select name="status" class="form-control" id="">
                                                    <option value="" disabled selected>Select One</option>
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">Submit</button>
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
                                            <strong>Services</strong>
                                            <span class="badge bg-blue">{{ $services->count() }}</span>
                                        </h3>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="text-right cutom_search" >
                                           <!-- Trigger the Create modal with a button -->
                                           <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#create"><i class="fa fa-plus-circle"></i>
                                             <span>Add Services</span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                        <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Title</th>
                                            <th>Image</th>
                                            <th>Details</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($services as $key=>$service)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $service->title }}</td>
                                                    <td>
                                                      <img style="width: 100px; height: 100px;" src="{{ asset($service->image) }}" alt="">
                                                    </td>
                                                    <td>{!! $service->details !!}</td>
                                                    <td>
                                                        @if($service->status == 1) 
                                                            <span class="badge" style="background: green; color: white;">Active</span>
                                                        @else
                                                            <span class="badge" style="background: red; color: white;">Inactive</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <!-- Trigger the edit modal with a button -->
                                                        @if($service->status == 1)
                                                            <a href="{{ route('admin.services.inactive', $service->id) }}" class="btn btn-xs btn-danger"><i class="fa fa-angle-down"></i></a>
                                                        @else
                                                            <a href="{{ route('admin.services.active', $service->id) }}" class="btn btn-xs btn-success"><i class="fa fa-angle-up"></i></a>
                                                        @endif
                                                        <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#edit_{{$key}}"><i class="fa fa-pencil"></i></button>
                                                        <button class="btn btn-danger waves-effect btn-xs" type="button" onclick="deleteData({{ $service->id }})">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                        <form id="delete-form-{{ $service->id }}" action="{{ route('admin.services.destroy',$service->id) }}" method="POST" style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </td>
                                                </tr>
                                                <div class="modal fade" id="edit_{{$key}}" role="dialog">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <form action="{{ route('admin.services.update',$service->id) }}" method="POST" enctype="multipart/form-data" >
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h4 class="modal-title">Edit Service </h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="form-group row">
                                                                        <label class="col-xs-3 col-form-label">Title</label>
                                                                        <div class="col-xs-9">
                                                                            <input type="text" class="form-control" required name="title" value="{{$service->title}}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-xs-3">
                                                                            <label for="link">Services Image <i class="text-danger">*</i></label>
                                                                        </div>
                                                                        <div class="col-xs-9">
                                                                            <input onChange="mainTham(this)" type="file" class="form-control" name="image">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-xs-3">
                                                                            <label for="link">Old Service Image<i class="text-danger">*</i></label>
                                                                        </div>
                                                                        <div class="col-xs-9">
                                                                            <input type="hidden" name="old_image" value="{{$service->image}}">
                                                                            <img style="width: 100px; height: 100px;" src="{{asset($service->image)}}" alt="" id="showTham">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-xs-3">
                                                                            <label for="link">Services Details <i class="text-danger">*</i></label>
                                                                        </div>
                                                                        <div class="col-xs-9">
                                                                            <textarea name="details" id="long_descriptionOne" cols="30" rows="10" class="form-control">
                                                                                {{$service->details}}
                                                                            </textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-xs-3">
                                                                            <label for="link">Status<i class="text-danger">*</i></label>
                                                                        </div>
                                                                        <div class="col-xs-9">
                                                                            <select name="status" class="form-control" id="">
                                                                                <option value="" disabled selected>Select One</option>
                                                                                <option @if($service->status == 1) selected @endif value="1">Active</option>
                                                                                <option @if($service->status == 0) selected @endif value="0">Inactive</option>
                                                                            </select>
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
    <script src="{{asset('assets/backend/plugins/ckeditor/ckeditor.js')}}"></script>
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
    <script type="text/javascript">
        function deleteData(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    // event.preventDefault();
                    document.getElementById('delete-form-'+id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        }
    </script>
    <script>
        $(document).ready(function() {
            // ck editor
            CKEDITOR.replace('long_description')
            CKEDITOR.replace('long_descriptionOne')
        });
    </script>
    <script>
        function mainTham(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showTham').attr('src', e.target.result).width(100).height(100)
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush
