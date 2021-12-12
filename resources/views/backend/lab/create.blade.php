@extends('backend.layout')
@section('title','Add Lab')
@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Lab Create</h4>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Add lab
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
                    <form method="post" class="form-horizontal" action="{{ route('admin.lab.store') }}"
                          enctype="multipart/form-data">
                        @method('post') @csrf
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group ">

                                        <label for="fname" class="text-end control-label col-form-label">Lab
                                            Name</label>
                                        <input type="text" class="form-control" id="name" value="{{ old('name') }}" name="name"
                                               placeholder="Enter Lab Full Name Here">
                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                            <p
                                                class="text-red">{{ $errors->first('name') }}</p> </span>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group ">

                                        <label for="fname" class="text-end control-label col-form-label">Lab
                                            Manager</label>
                                        <input type="text" name="lab_manager" class="form-control" id="lab_manager"
                                               lab_manager="lab_manager"
                                               placeholder="Enter lab manager name">
                                        @if ($errors->has('lab_manager'))
                                            <span class="help-block">
                                            <p
                                                class="text-red">{{ $errors->first('lab_manager') }}</p> </span>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group ">

                                        <label for="fname" class="text-end control-label col-form-label">Lab
                                            Manager Contact</label>
                                        <input type="text" name="manager_contact" class="form-control"
                                               id="manager_contact"
                                               manager_contact="manager_contact"
                                               placeholder="Enter manager contact number">
                                        @if ($errors->has('manager_contact'))
                                            <span class="help-block">
                                            <p
                                                class="text-red">{{ $errors->first('manager_contact') }}</p> </span>
                                        @endif

                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group ">

                                        <label for="fname" class="text-end control-label col-form-label">Lab
                                            Director</label>
                                        <input type="text" name="lab_director" class="form-control" id="lab_director"
                                               lab_director="lab_director"
                                               placeholder="Enter lab director name">
                                        @if ($errors->has('lab_director'))
                                            <span class="help-block">
                                            <p
                                                class="text-red">{{ $errors->first('lab_director') }}</p> </span>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group ">

                                        <label for="fname" class="text-end control-label col-form-label">Lab
                                            Director Contact</label>
                                        <input type="text" name="director_contact" class="form-control"
                                               id="director_contact"
                                               director_contact="director_contact"
                                               placeholder="Enter lab director contact number">
                                        @if ($errors->has('director_contact'))
                                            <span class="help-block">
                                            <p
                                                class="text-red">{{ $errors->first('director_contact') }}</p> </span>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group ">

                                        <label for="fname" class="text-end control-label col-form-label">Fax</label>
                                        <input type="text" name="fax" class="form-control" id="fax" fax="fax"
                                               placeholder="Enter fax number">
                                        @if ($errors->has('fax'))
                                            <span class="help-block">
                                            <p
                                                class="text-red">{{ $errors->first('fax') }}</p> </span>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group ">

                                        <label for="fname" class="text-end control-label col-form-label">Phone</label>
                                        <input type="text" name="phone" class="form-control" id="phone" phone="phone"
                                               placeholder="Enter phone number">
                                        @if ($errors->has('phone'))
                                            <span class="help-block">
                                            <p
                                                class="text-red">{{ $errors->first('phone') }}</p> </span>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group ">

                                        <label for="fname" class="text-end control-label col-form-label">Address</label>
                                        <input type="text" name="address" class="form-control" id="address"
                                               address="address"
                                               placeholder="Enter address here">
                                        @if ($errors->has('address'))
                                            <span class="help-block">
                                            <p
                                                class="text-red">{{ $errors->first('address') }}</p> </span>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group ">

                                        <label for="fname" class="text-end control-label col-form-label">Logo</label>
                                        <input type="file" name="logo" class="form-control" id="logo"
                                               placeholder="Enter logo here">
                                        @if ($errors->has('logo'))
                                            <span class="help-block">
                                            <p
                                                class="text-red">{{ $errors->first('logo') }}</p> </span>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary">
                                    Save Lab
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
            <!-- Column -->

            <!-- Column -->
        </div>
        <!-- ============================================================== -->
        <!-- Sales chart -->
        <!-- ============================================================== -->


    </div>

    @push('extra-script')

    @endpush
@endsection
