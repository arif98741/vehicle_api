@extends('backend.layout')
@section('title','Dashboard')
@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Dashboard</h4>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Library
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-md-flex align-items-center">
                            <div>
                                <h4 class="card-title">Add Service to Site</h4>
                                <h5 class="card-subtitle">Please fillup the below form with correct details</h5>
                            </div>
                        </div>
                        <div class="row">
                            <!-- column -->
                            <form method="post" class="form-horizontal" action="{{ route('backend.user.store') }}"
                                  enctype="multipart/form-data">
                                @method('post') @csrf
                                <div class="card-body">
                                    <fieldset>
                                        <legend>Personal Information:</legend>
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group ">

                                                    <label for="first_name"
                                                           class="text-end control-label col-form-label">First
                                                        Name</label>
                                                    <input type="text" class="form-control" id="first_name"
                                                           name="first_name"
                                                           placeholder="Enter first name here"
                                                           value="{{ old('first_name') }}">
                                                    @if ($errors->has('first_name'))
                                                        <span class="help-block">
                                            <p class="text-red">{{ $errors->first('first_name') }}</p> </span>
                                                    @endif

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group ">

                                                    <label for="last_name"
                                                           class="text-end control-label col-form-label">Last
                                                        Name</label>
                                                    <input type="text" class="form-control" id="last_name"
                                                           name="last_name"
                                                           placeholder="Enter last name here"
                                                           value="{{ old('last_name') }}">
                                                    @if ($errors->has('last_name'))
                                                        <span class="help-block">
                                            <p class="text-red">{{ $errors->first('last_name') }}</p> </span>
                                                    @endif

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group ">

                                                    <label for="email"
                                                           class="text-end control-label col-form-label">Last
                                                        Name</label>
                                                    <input type="text" class="form-control" id="email"
                                                           name="email"
                                                           placeholder="Enter email address here"
                                                           value="{{ old('emails') }}">
                                                    @if ($errors->has('emails'))
                                                        <span class="help-block">
                                            <p class="text-red">{{ $errors->first('emails') }}</p> </span>
                                                    @endif

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group ">

                                                    <label for="password"
                                                           class="text-end control-label col-form-label">Password</label>
                                                    <input type="text" class="form-control" id="password"
                                                           name="password"
                                                           placeholder="Enter password heree"
                                                           value="{{ old('password') }}">
                                                    @if ($errors->has('password'))
                                                        <span class="help-block">
                                            <p class="text-red">{{ $errors->first('password') }}</p> </span>
                                                    @endif

                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <button type="submit" class="btn btn-primary">
                                                    Go to next step
                                                </button>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>

                                <div class="card-body">

                                </div>
                            </form>

                            <!-- column -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @push('extra-script')

    @endpush
@endsection
