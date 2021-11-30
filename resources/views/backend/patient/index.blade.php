@extends('backend.layout')
@section('title','Patient List')
@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Patient List</h4>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Patient List
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
                                    <th>Patient Name</th>
                                    <th>Lab</th>
                                    <th>MRN</th>
                                    <th>Patient ID</th>
                                    <th>Registration Date</th>
                                    <th>Collection Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($patients as $key=> $patient)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $patient->patient_name }}</td>
                                        <td>{{ $patient->lab->name }}</td>
                                        <td>{{ $patient->mrn }}</td>
                                        <td>{{ $patient->patient_id }}</td>
                                        <td>{{ date('d-m-Y',strtotime($patient->registration_date)) }}</td>
                                        <td>{{ date('d-m-Y',strtotime($patient->collection_date)) }}</td>
                                        <td>
                                            <a href="{{ route('admin.patient.edit',$patient->id) }}">Edit</a>
                                            |
                                            <a href="{{ url('admin/patient/view-report/'.$patient->id) }}">View</a>

                                        </td>
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
