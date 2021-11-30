@extends('backend.layout')
@section('title','Lab List')
@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Lab List</h4>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Lab List
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Sales Cards  -->
        <!-- ============================================================== -->
        <div class="row">
            <!-- Column -->
            <div class="col-md-12" data-select2-id="15">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table
                                id="zero_config"
                                class="table table-striped table-bordered"
                            >
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Lab Manager</th>
                                    <th>Lab Director</th>
                                    <th>Phone</th>
                                    <th>Fax</th>
                                    <th>Address</th>
                                    <th>Logo</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($labs as $key=> $lab)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $lab->name }}</td>
                                        <td>{{ $lab->lab_manager }}</td>
                                        <td>{{ $lab->lab_director }}</td>
                                        <td>{{ $lab->phone }}</td>
                                        <td>{{ $lab->fax }}</td>
                                        <td>{{ $lab->address }}</td>
                                        <td><img src="{{ asset('uploads/lab/'.$lab->logo) }}" style="width: 60px; height: 60px;" alt=""></td>
                                        <td><a href="{{ route('admin.lab.edit',$lab->id) }}">Edit</a></td>
                                    </tr>

                                @endforeach

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <!-- Column -->

            <!-- Column -->
        </div>
        <!-- ============================================================== -->
        <!-- Sales chart -->
        <!-- ============================================================== -->


    </div>

    @push('extra-css')
        <link href="{{ asset('backend/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet"/>
    @endpush

    @push('extra-script')

        <script src="{{asset('backend/assets/extra-libs/multicheck/datatable-checkbox-init.js')}}"></script>
        <script src="{{asset('backend/assets/extra-libs/multicheck/jquery.multicheck.js')}}"></script>
        <script src="{{asset('backend/assets/extra-libs/DataTables/datatables.min.js')}}"></script>
        <script>
            /****************************************
             *       Basic Table                   *
             ****************************************/
            $("#zero_config").DataTable();
        </script>
    @endpush
@endsection
