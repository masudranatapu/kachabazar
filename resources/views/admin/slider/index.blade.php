@extends('layouts.backend.app')

@section('title','Slider')

@push('css')

@endpush

@section('content')
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Slider</li>
      </ol>
    </section>

    <div class="clearfix">
        <div class="pro_back">
            <div class="container-fluid d_table">
                <div class="block-header ">

                      <!-- Create Modal -->
                      <div class="modal fade" id="create" role="dialog">
                        <div class="modal-dialog">

                          <!--Add Modal content-->
                          <div class="modal-content">
                           <form action="{{ route('admin.slider.store') }}" method="POST" enctype="multipart/form-data" >
                               @csrf

                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Add slider </h4>
                            </div>
                            <div class="modal-body">
                              <div class="form-group row">
                                  <label for="Slider Image" class="col-xs-3 col-form-label">Image(1140x292px) </label>
                                  <div class="col-xs-9">
                                      <input type="file" required name="image" id="Slider Image" value="">
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <div class="col-xs-3">
                                    <label for="link">Link <i class="text-danger">*</i></label>
                                  </div>
                                  <div class="col-xs-9">
                                      <input type="text" required class="form-control" name="link" value=""  placeholder="Link">
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
                                            <strong>Sliders</strong>
                                            <span class="badge bg-blue">{{ $slider->count() }}</span>
                                        </h3>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="text-right cutom_search" >
                                           <!-- Trigger the Create modal with a button -->
                                           <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#create"><i class="fa fa-plus-circle"></i>
                                             <span>Add Slider</span></button>
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
                                            <th width="30%">Slider image</th>
                                            <th>Link</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($slider as $key=>$slider)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>
                                                      <img class="img-responsive" width="200px" height="140px"  style="border-radius: 2px;" src="{{ URL::to($slider->image) }}" alt="">
                                                    </td>
                                                    <td>{{ $slider->link }}</td>
                                                    <td class="text-center">
                                                        <!-- Trigger the edit modal with a button -->
                                                          <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#edit_{{$key}}"><i class="fa fa-pencil"></i></button>

                                                        <button class="btn btn-danger waves-effect btn-xs" type="button" onclick="deleteData({{ $slider->id }})">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                        <form id="delete-form-{{ $slider->id }}" action="{{ route('admin.slider.destroy',$slider->id) }}" method="POST" style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </td>
                                                </tr>

                                  <!-- edit Modal -->
                                  <div class="modal fade" id="edit_{{$key}}" role="dialog">
                                    <div class="modal-dialog">

                                      <!--Edit Modal content-->
                                      <div class="modal-content">
                                       <form action="{{ route('admin.slider.update',$slider->id) }}" method="POST" enctype="multipart/form-data" >
                                          @csrf
                                          @method('PUT')

                                        <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                          <h4 class="modal-title">Edit Slider </h4>
                                        </div>
                                        <div class="modal-body">

                                          <div class="form-group row">
                                              <div class="col-xs-3"></div>
                                              <div class="col-xs-9">
                                                <img class="img-responsive" width="200px" height="150px;"  style="border-radius: 2px;" src="{{ Storage::disk('public')->url($slider->image) }}" alt="">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="Slider Image" class="col-xs-3 col-form-label">Image(1140x292px) </label>
                                              <div class="col-xs-9">
                                                  <input type="file" name="image" id="Slider Image" value="">
                                              </div>
                                          </div>

                                          <div class="form-group row">
                                              <div class="col-xs-3">
                                                <label for="link">Link <i class="text-danger">*</i></label>
                                              </div>
                                              <div class="col-xs-9">
                                                  <input type="text" required class="form-control" name="link" value="{{ $slider->link }}"  placeholder="Link">
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
@endpush
