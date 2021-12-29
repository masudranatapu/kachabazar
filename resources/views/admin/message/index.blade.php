@extends('layouts.backend.app')

@section('title')
    {{$title}}
@endsection

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
        <li class="active">Message</li>
      </ol>
    </section>

    <div class="clearfix">
        <div class="pro_back">
            <div class="container-fluid d_table">
                <!-- Exportable Table -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    <strong>{{$title}} list</strong>
                                    <span class="badge bg-blue">{{ $messeges->count() }}</span>
                                </h2>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                        <thead>
                                        <tr>
                                            <th width="5%">SL</th>
                                            <th width="15%">Name</th>
                                            <th width="10%">Phone</th>
                                            <th width="15%">Email</th>
                                            <th width="35%">Message</th>
                                            <th  width="10%" class="text-center">Date</th>
                                            <th  width="10%" class="text-center">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($messeges as $key=>$messege)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{ $messege->name }}</td>
                                                    <td>{{ $messege->phone }}</td>
                                                    <td>{{ $messege->email }}</td>
                                                    <td>{{ $messege->message }}</td>
                                                    <td>{{ $messege->created_at->format('d-m-Y') }}</td>
                                                    <td class="text-center">
                                                        <button class="btn btn-danger btn-xs waves-effect" type="button" onclick="deleteData({{ $messege->id }})">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                        <form id="delete-form-{{ $messege->id }}" action="{{ route('admin.message.destroy',$messege->id) }}" method="POST" style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </td>
                                                    
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{$messeges->onEachSide(2)->links()}}
                                    
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

    <script src="{{ asset('assets/backend/js/jquery-datatable.js') }}"></script>
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>

    <script>
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