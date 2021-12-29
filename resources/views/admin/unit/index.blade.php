@extends('layouts.backend.app')

@section('title','Unit')

@push('css')
    <!-- JQuery DataTable Css -->
    <link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">

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
        <li class="active">Unit</li>
      </ol>
    </section>

    <div class="clearfix">
        <div class="pro_back">
            <div class="container-fluid d_table">
                <div class="block-header ">

                    <!-- Trigger the Create modal with a button -->
                      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#create"><i class="fa fa-plus-circle"></i>
                        <span>Create Unit</span></button>

                      <!-- Create Modal -->
                      <div class="modal fade" id="create" role="dialog">
                        <div class="modal-dialog">

                          <!--Create Modal content-->
                          <div class="modal-content">
                           <form action="{{ route('admin.unit.store') }}" method="POST" >
                               @csrf

                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Create Unit </h4>
                            </div>
                            <div class="modal-body">

                              <div class="form-group row">
                                  <div class="col-xs-3">
                                    <label for="name">Unit <i class="text-danger">*</i></label>
                                  </div>
                                  <div class="col-xs-9">
                                      <input type="text" required class="form-control" name="name" value=""  placeholder="unit">
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
                                <h2>
                                    <strong>Unit list</strong>
                                    <span class="badge bg-blue">{{ $unit->count() }}</span>
                                </h2>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                        <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Unit</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($unit as $key=>$unit)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $unit->name }}</td>
                                                    <td>{{ $unit->status }}</td>
                                                    <td class="text-center">
                                                        <!-- Trigger the edit modal with a button -->
                                                          <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#edit_{{$key}}"><i class="fa fa-pencil"></i></button>

                                                        {{-- <button class="btn btn-danger waves-effect" type="button" onclick="deleteData({{ $unit->id }})">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                        <form id="delete-form-{{ $unit->id }}" action="{{ route('admin.unit.destroy',$unit->id) }}" method="POST" style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form> --}}
                                                    </td>
                                                </tr>

                                  <!-- edit Modal -->
                                  <div class="modal fade" id="edit_{{$key}}" role="dialog">
                                    <div class="modal-dialog">

                                      <!--Edit Modal content-->
                                      <div class="modal-content">
                                       <form action="{{ route('admin.unit.update',$unit->id) }}" method="POST"  >
                                          @csrf
                                          @method('PUT')

                                        <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                          <h4 class="modal-title">Edit Unit </h4>
                                        </div>
                                        <div class="modal-body">

                                          <div class="form-group row">
                                              <div class="col-xs-3">
                                                <label for="name">Unit <i class="text-danger">*</i></label>
                                              </div>
                                              <div class="col-xs-9">
                                                  <input type="text" required class="form-control" name="name" value="{{$unit->name}}"  placeholder="unit">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                            <label class="col-sm-3">Status</label>
                                            <div class="col-xs-9">
                                                <div class="form-check">
                                                    <label class="radio-inline">
                                                    <input type="radio" name="status" value="Active" @if($unit->status == "Active") checked @endif >Active</label>
                                                    <label class="radio-inline">
                                                    <input type="radio" name="status" @if($unit->status == "Inactive") checked @endif value="Inactive"  >Inactive</label>
                                                </div>
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
                <!-- #END# Exportable Table -->
            </div>
        </div>
    </div>

@endsection

@push('js')
    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>

    <script src="{{ asset('assets/backend/js/jquery-datatable.js') }}"></script>
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

        jQuery(document).ready(function($) {
            //Initialize Select2 Elements
            $('.select2').select2()
        });
    </script>

    <!-- Select2 -->
    <script src="{{asset('assets/backend/bower_components/select2/dist/js/select2.full.min.js')}} "></script>
@endpush
