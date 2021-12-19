@extends('backend.layout')
@section('title','Add Service')
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
                            <form method="post" class="form-horizontal" action="{{ route('backend.service.store') }}"
                                  enctype="multipart/form-data">
                                @method('post') @csrf
                                <div class="card-body">
                                    <fieldset>
                                        <div class="row">

                                            <form action="">
                                                <div class="col-md-6">
                                                    <div class="form-group ">

                                                        <label for="first_name"
                                                               class="text-end control-label col-form-label">Service
                                                            Name</label>
                                                        <input type="text" class="form-control" id="service_name"
                                                               name="service_name"
                                                               placeholder="Enter service name"
                                                               value="{{ old('service_name') }}">
                                                        @if ($errors->has('service_name'))
                                                            <span class="help-block">
                                            <p class="text-red">{{ $errors->first('service_name') }}</p> </span>
                                                        @endif

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group ">

                                                        <label for="last_name"
                                                               class="text-end control-label col-form-label">Service
                                                            Category</label>
                                                        <select name="service_category_id"  class="form-control">

                                                            <option value="">Select Category</option>
                                                            @foreach($service_categories as $service_category)

                                                                <option
                                                                    value="{{ $service_category->id }}">{{ $service_category->category_name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @if ($errors->has('service_category_id'))
                                                            <span class="help-block">
                                            <p class="text-red">{{ $errors->first('service_category_id') }}</p> </span>
                                                        @endif

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group ">

                                                        <label for="first_name"
                                                               class="text-end control-label col-form-label">Service
                                                            Price</label>
                                                        <input type="number" class="form-control text-right" id="price"
                                                               name="price"
                                                               placeholder="Enter price here"
                                                               value="{{ old('price') }}">
                                                        @if ($errors->has('price'))
                                                            <span class="help-block">
                                            <p class="text-red">{{ $errors->first('price') }}</p> </span>
                                                        @endif

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group ">

                                                        <label for="service_image"
                                                               class="text-end control-label col-form-label">Service Image</label>
                                                        <input type="file" class="form-control text-right"
                                                               name="service_image"
                                                               placeholder="Enter price here"
                                                               value="{{ old('service_image') }}">
                                                        @if ($errors->has('service_image'))
                                                            <span class="help-block">
                                            <p class="text-red">{{ $errors->first('service_image') }}</p> </span>
                                                        @endif

                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group ">

                                                        <label for="description"
                                                               class="text-end control-label col-form-label">Desciption</label>
                                                        <textarea name="description" id="" cols="30" rows="4"
                                                                  class="form-control">{{ old('description') }}</textarea>
                                                        @if ($errors->has('description'))
                                                            <span class="help-block">
                                            <p class="text-red">{{ $errors->first('description') }}</p> </span>
                                                        @endif

                                                    </div>
                                                </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <button type="submit" class="btn btn-primary">
                                                    Save
                                                </button>
                                            </div>
                                        </div>
                                            </form>
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
