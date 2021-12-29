@extends('layouts.backend.app')

@section('title','Payment Getway')

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
        <li class="active">Payment Methoad</li>
      </ol>
    </section>

    <div class="clearfix">
        <div class="pro_back">
            <div class="container-fluid d_table">
                <div class="block-header ">

                    <!-- Trigger the Create modal with a button -->
                      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#create"><i class="fa fa-plus-circle"></i>
                        <span>Create Payment Getway</span></button>

                      <!-- Create Modal -->
                      <div class="modal fade" id="create" role="dialog">
                        <div class="modal-dialog">
                        
                          <!--Create Modal content-->
                          <div class="modal-content">
                           <form action="{{ route('admin.payment.store') }}" method="POST" >
                               @csrf

                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Create Payment Getway </h4>
                            </div>
                            <div class="modal-body">

                              <div class="form-group row">
                                  <div class="col-xs-3">
                                    <label for="name">Payment Name <i class="text-danger">*</i></label>
                                  </div>
                                  <div class="col-xs-9">
                                      <select name="name" id="selected_payment" class="form-control" required>
                                            <option value="" selected disabled>Select One</option>
                                            <option value="Cash">Cash on Delivery</option>
                                            <option value="Bkash">Bkash</option>
                                            <option value="Rocket">Rocket</option>
                                            <option value="Nagad">Nagad</option>
                                        </select>
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <div class="col-xs-3">
                                    <label for="name">Phone Number <i class="text-danger">*</i></label>
                                  </div>
                                  <div class="col-xs-9">
                                      <input type="text" class="form-control" name="phone" placeholder="Payment Phone Number">
                                  </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-3">Payment Status <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <select name="status" id="" required class="form-control">
                                        <option value="" disabled="" selected="">Select One</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
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
                      </div> {{-- model end --}}
                </div>
                <!-- Exportable Table -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    <strong>Payment Method list</strong>
                                    <span class="badge bg-blue">{{ $payments->count() }}</span>
                                </h2>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                        <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Name</th>
                                            <th>Phone Number</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($payments as $key => $payment)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{$payment->name}}</td>
                                                    <td>{{$payment->phone}}</td>
                                                    <td>
                                                        @if($payment->status ==1) 
                                                            <span class="badge" style="background: green;">Active</span>
                                                        @else 
                                                            <span class="badge" style="background: red;">Inactive</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        @if($payment->status == 1) 
                                                            <a class="btn btn-danger btn-xs" href="{{route('admin.payment.inactive', $payment->id)}}">
                                                                <i class="fa fa-angle-double-down"></i>
                                                            </a>   
                                                        @else
                                                            <a class="btn btn-success btn-xs" href="{{route('admin.payment.active', $payment->id)}}">
                                                                <i class="fa fa-angle-double-up"></i>
                                                            </a> 
                                                        @endif
                                                        <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#edit_{{$key}}"><i class="fa fa-pencil"></i></button>
                                                        <button class="btn btn-danger btn-xs" type="button" onclick="deleteData({{ $payment->id }})">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                        <form id="delete-form-{{ $payment->id }}" action="{{ route('admin.payment.destroy',$payment->id) }}" method="POST" style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form> 
                                                    </td>
                                                </tr>
                                                <!-- edit Modal -->
                                                <div class="modal fade" id="edit_{{$key}}" role="dialog">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form action="{{ route('admin.payment.update',$payment->id) }}" method="POST"  >
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h4 class="modal-title">Edit Payment Method</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="form-group row">
                                                                        <div class="col-xs-3">
                                                                            <label for="name">Payment Name <i class="text-danger">*</i></label>
                                                                        </div>
                                                                        <div class="col-xs-9">
                                                                            <select name="name" id="" class="form-control" required>
                                                                                <option value="" selected disabled>Select One</option>
                                                                                <option @if($payment->name == 'Cash') selected  @endif value="Cash">Cash on Delivery</option>
                                                                                <option @if($payment->name == 'Bkash') selected  @endif value="Bkash">Bkash</option>
                                                                                <option @if($payment->name == 'Rocket') selected  @endif value="Rocket">Rocket</option>
                                                                                <option @if($payment->name == 'Nagad') selected  @endif value="Nagad">Nagad</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-xs-3">
                                                                            <label for="name">Phone Number <i class="text-danger">*</i></label>
                                                                        </div>
                                                                        <div class="col-xs-9">
                                                                            <input type="text" class="form-control" name="phone" value="{{$payment->phone}}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3">Payment Status <i class="text-danger">*</i></label>
                                                                        <div class="col-xs-9">
                                                                            <select name="status" id="" required class="form-control">
                                                                                <option value="" disabled="" selected="">Select One</option>
                                                                                <option @if($payment->status == 1) selected @else @endif value="1">Active</option>
                                                                                <option @if($payment->status == 0) selected @else @endif value="0">Inactive</option>
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