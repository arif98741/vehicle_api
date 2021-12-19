@extends('backend.layout')
@section('title','Edit User')
@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Edit User</h4>
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

                        <div class="row">
                            <!-- column -->
                            <form method="post" class="form-horizontal"
                                  action="{{ route('backend.user.update',$user->id) }}"
                                  enctype="multipart/form-data">
                                @method('put') @csrf
                                <div class="card-body">
                                    <fieldset>
                                        <div class="row">

                                            <form action="">
                                                <div class="col-md-6">
                                                    <div class="form-group ">

                                                        <label for="first_name"
                                                               class="text-end control-label col-form-label">First
                                                            Name</label>
                                                        <input type="text" class="form-control" id="first_name"
                                                               name="first_name"
                                                               placeholder="Enter first name"
                                                               value="{{ !empty(old('first_name'))  ? old('first_name'): $user->first_name }}">
                                                        @if ($errors->has('first_name'))
                                                            <span class="help-block">
                                            <p class="text-red">{{ $errors->first('first_name') }}</p> </span>
                                                        @endif

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group ">

                                                        <label for="first_name"
                                                               class="text-end control-label col-form-label">Last
                                                            Name</label>
                                                        <input type="text" class="form-control" id="last_name"
                                                               name="last_name"
                                                               placeholder="Enter first name"
                                                               value="{{ !empty(old('last_name'))  ? old('last_name'): $user->last_name }}">
                                                        @if ($errors->has('last_name'))
                                                            <span class="help-block">
                                            <p class="text-red">{{ $errors->first('last_name') }}</p> </span>
                                                        @endif

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group ">

                                                        <label for="first_name"
                                                               class="text-end control-label col-form-label">Email</label>
                                                        <input type="email" class="form-control" id="email"
                                                               name="email"
                                                               placeholder="Enter email address"
                                                               value="{{ !empty(old('email'))  ? old('email'): $user->email }}">
                                                        @if ($errors->has('email'))
                                                            <span class="help-block">
                                            <p class="text-red">{{ $errors->first('email') }}</p> </span>
                                                        @endif

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group ">

                                                        <label for="first_name"
                                                               class="text-end control-label col-form-label">Phone</label>
                                                        <input type="text" class="form-control" id="phone"
                                                               name="phone"
                                                               placeholder="Enter phone number"
                                                               value="{{ !empty(old('phone'))  ? old('phone'): $user->phone }}">
                                                        @if ($errors->has('phone'))
                                                            <span class="help-block">
                                            <p class="text-red">{{ $errors->first('phone') }}</p> </span>
                                                        @endif

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group ">

                                                        <label for="email"
                                                               class="text-end control-label col-form-label">Select
                                                            Role</label>
                                                        <select name="role_id" class="form-control">

                                                            <option value="">Select role</option>
                                                            @foreach($roles as $role)
                                                                <option
                                                                    value="{{ $role->id }}" {{ ($user->role_id == $role->id)  ? 'selected': '' }}>{{ $role->name }}</option>
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

                                                        <label for="email"
                                                               class="text-end control-label col-form-label">Documents
                                                            Verified </label>
                                                        <select name="documents_verified" class="form-control">

                                                            <option value="">Select</option>
                                                            <option
                                                                value="1" {{ ($user->documents_verified =='1')  ? 'selected': '' }}>
                                                                Yes
                                                            </option>
                                                            <option
                                                                value="0" {{ ($user->documents_verified == 0)  ? 'selected': '' }}>
                                                                No
                                                            </option>

                                                        </select>
                                                        @if ($errors->has('documents_verified'))
                                                            <span class="help-block">
                                            <p class="text-red">{{ $errors->first('documents_verified') }}</p> </span>
                                                        @endif

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group ">

                                                        <label for="email"
                                                               class="text-end control-label col-form-label">Otp
                                                            Verified </label>
                                                        <select name="otp_verified" class="form-control">

                                                            <option value="">Select</option>
                                                            <option
                                                                value="1" {{ ($user->otp_verified =='1')  ? 'selected': '' }}>
                                                                Yes
                                                            </option>
                                                            <option
                                                                value="0" {{ ($user->otp_verified ==0)  ? 'selected': '' }}>
                                                                No
                                                            </option>

                                                        </select>
                                                        @if ($errors->has('otp_verified'))
                                                            <span class="help-block">
                                            <p class="text-red">{{ $errors->first('otp_verified') }}</p> </span>
                                                        @endif

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group ">

                                                        <label for="email"
                                                               class="text-end control-label col-form-label">Status</label>
                                                        <select name="status" class="form-control">

                                                            <option value="">Select</option>
                                                            <option
                                                                value="1" {{ ($user->status =='1')  ? 'selected': '' }}>
                                                                Active
                                                            </option>
                                                            <option
                                                                value="0" {{ ($user->status ==0)  ? 'selected': '' }}>
                                                                Inactive
                                                            </option>

                                                        </select>
                                                        @if ($errors->has('status'))
                                                            <span class="help-block">
                                            <p class="text-red">{{ $errors->first('status') }}</p> </span>
                                                        @endif

                                                    </div>
                                                </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <input type="hidden" name="id" value="{{ $user->id }}">
                                                <button type="submit" class="btn btn-primary">
                                                    Update
                                                </button>
                                            </div>
                                        </div>
                            </form>

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
