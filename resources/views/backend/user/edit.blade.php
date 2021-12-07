@extends('backend.layout')
@section('title','Edit Patient')
@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Edit Patient</h4>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Edit Patient
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
                    <form method="post" class="form-horizontal"
                          action="{{ route('admin.patient.update',$patient->id) }}" enctype="multipart/form-data">
                        @method('put') @csrf
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group ">

                                        <label for="fname" class="text-end control-label col-form-label">Patient
                                            Name</label>
                                        <input type="text" class="form-control" id="patient_name"
                                               name="patient_name"
                                               placeholder="Enter Patient Full Name Here"
                                               value="{{ (!empty(old('patient_name'))) ? old('patient_name'): $patient->patient_name }}">
                                        @if ($errors->has('patient_name'))
                                            <span class="help-block">
                                            <p class="text-red">{{ $errors->first('patient_name') }}</p> </span>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group ">

                                        <label for="fname" class="text-end control-label col-form-label">Lab Id</label>
                                        <select name="lab_id" id="lab_id" class="form-control">
                                            <option value="" disabled selected>Select Lab</option>
                                            @foreach($labs as $key=> $lab)
                                                <option
                                                    value="{{ $lab->id }}" {{ ($lab->id == $patient->lab_id) ? 'selected': '' }}>{{ $lab->name     }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('lab_id'))
                                            <span class="help-block">
                                            <p class="text-red">{{ $errors->first('lab_id') }}</p> </span>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group ">

                                        <label class="text-end control-label col-form-label">Nationality</label>
                                        <select name="nationality" id="nationality" class="form-control">
                                            <option value="" disabled selected>Select Country</option>
                                            @foreach($countries as $key=> $country)
                                                <option
                                                    value="{{ $country }}"
                                                    @if($country == $patient->nationality) selected @endif>{{ $country    }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('nationality'))
                                            <span class="help-block">
                                            <p class="text-red">{{ $errors->first('nationality') }}</p> </span>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group ">

                                        <label for="fname" class="text-end control-label col-form-label">MRN</label>
                                        <input type="text" class="form-control" id="mrn" name="mrn"
                                               placeholder="Enter mrn here"
                                               value="{{ (!empty(old('mrn'))) ? old('mrn'): $patient->mrn }}">
                                        @if ($errors->has('mrn'))
                                            <span class="help-block">
                                            <p class="text-red">{{ $errors->first('mrn') }}</p> </span>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group ">

                                        <label for="fname" class="text-end control-label col-form-label">Passport
                                            NO</label>
                                        <input type="text" class="form-control" id="passport" name="passport"
                                               placeholder="Enter passport here"
                                               value="{{ (!empty(old('passport'))) ? old('passport'): $patient->passport }}">
                                        @if ($errors->has('passport'))
                                            <span class="help-block">
                                            <p class="text-red">{{ $errors->first('passport') }}</p> </span>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group ">

                                        <label for="fname" class="text-end control-label col-form-label">UAE ID</label>
                                        <input type="text" class="form-control" id="uae_id" name="uae_id"
                                               placeholder="Enter uae_id here"
                                               value="{{ (!empty(old('uae_id'))) ? old('uae_id'): $patient->uae_id }}">
                                        @if ($errors->has('uae_id'))
                                            <span class="help-block">
                                            <p class="text-red">{{ $errors->first('uae_id') }}</p> </span>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group ">

                                        <label for="fname"
                                               class="text-end control-label col-form-label">Reference</label>
                                        <input type="text" class="form-control" id="reference" name="reference"
                                               placeholder="Enter reference number"
                                               value="{{ (!empty(old('reference'))) ? old('reference'): $patient->reference }}">
                                        @if ($errors->has('reference'))
                                            <span class="help-block">
                                            <p class="text-red">{{ $errors->first('reference') }}</p> </span>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group ">

                                        <label for="fname"
                                               class="text-end control-label col-form-label">Sample No</label>
                                        <input type="text" class="form-control" id="sample" name="sample"
                                               placeholder="Enter sample number"
                                               value="{{ (!empty(old('sample'))) ? old('sample'): $patient->sample }}">
                                        @if ($errors->has('sample'))
                                            <span class="help-block">
                                            <p class="text-red">{{ $errors->first('sample') }}</p> </span>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-md-3">

                                    <div class="form-group " id="date_of_birth">

                                        <label for="fname"
                                               class="text-end control-label col-form-label">Date of birth</label>
                                        <input type="text" class="form-control" name="date_of_birth"
                                               placeholder="Enter date of birth"
                                               value="{{ (!empty(old('date_of_birth'))) ? date('Y-m-d',strtotime(old('date_of_birth'))): date('Y-m-d',strtotime($patient->date_of_birth)) }}">
                                        @if ($errors->has('date_of_birth'))
                                            <span class="help-block">
                                            <p class="text-red">{{ $errors->first('date_of_birth') }}</p> </span>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group ">

                                        <label for="fname"
                                               class="text-end control-label col-form-label">Gender</label>
                                        <select name="gender" id="gender" required="" class="form-control">
                                            <option value="" disabled selected>Select Gender</option>
                                            <option value="Male" @if($patient->gender == 'Male') selected="" @endif>Male
                                            </option>
                                            <option value="Female"
                                                    @if($patient->gender == 'Female')  selected="" @endif>
                                                Female
                                            </option>
                                            <option value="Other" @if($patient->gender == 'Other') selected="" @endif>
                                                Other
                                            </option>
                                        </select>
                                        @if ($errors->has('gender'))
                                            <span class="help-block">
                                            <p class="text-red">{{ $errors->first('gender') }}</p> </span>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group ">

                                        <label for="fname"
                                               class="text-end control-label col-form-label">Patient ID</label>
                                        <input type="text" class="form-control" id="patient_id"
                                               name="patient_id" placeholder="Enter patient id"
                                               value="{{ (!empty(old('patient_id'))) ? old('patient_id'): $patient->patient_id }}">
                                        @if ($errors->has('patient_id'))
                                            <span class="help-block">
                                            <p class="text-red">{{ $errors->first('patient_id') }}</p> </span>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group " id="registration_date">

                                        <label for="fname"
                                               class="text-end control-label col-form-label">Registration Date</label>
                                        <input type="text" class="form-control"
                                               name="registration_date" placeholder="Enter date of birth"
                                               value="{{ date('Y-m-d',strtotime($patient->registration_date)) }}">
                                        @if ($errors->has('registration_date'))
                                            <span class="help-block">
                                            <p class="text-red">{{ $errors->first('registration_date') }}</p> </span>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group ">

                                        <label for="fname"
                                               class="text-end control-label col-form-label">Registration Time</label>
                                        <input type="time" class="form-control registration_time"
                                               name="registration_time"
                                               placeholder="Enter date of birth"
                                               value="{{ date('H:i',strtotime($patient->registration_date)) }}">
                                        @if ($errors->has('registration_time'))
                                            <span class="help-block">
                                            <p class="text-red">{{ $errors->first('registration_time') }}</p> </span>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group " id="collection_date">

                                        <label for="fname"
                                               class="text-end control-label col-form-label">Collection Date</label>
                                        <input type="text" class="form-control"
                                               name="collection_date" placeholder="Enter date of birth"
                                               value="{{ date('Y-m-d',strtotime($patient->collection_date)) }}">
                                        @if ($errors->has('collection_date'))
                                            <span class="help-block">
                                            <p class="text-red">{{ $errors->first('collection_date') }}</p> </span>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group ">

                                        <label for="fname"
                                               class="text-end control-label col-form-label">Collection Time</label>
                                        <input type="time" class="form-control collection_time"
                                               name="collection_time"
                                               placeholder="Enter collection time"
                                               value="{{ date('H:i',strtotime($patient->collection_date)) }}">
                                        @if ($errors->has('collection_time'))
                                            <span class="help-block">
                                            <p class="text-red">{{ $errors->first('collection_time') }}</p> </span>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group " id="reporting_date">

                                        <label for="fname"
                                               class="text-end control-label col-form-label">Reporting Date</label>
                                        <input type="text" class="form-control reporting_date"
                                               name="reporting_date"
                                               placeholder="Enter reporting date"
                                               value="{{ date('Y-m-d',strtotime($patient->reporting_date)) }}">
                                        @if ($errors->has('reporting_date'))
                                            <span class="help-block">
                                            <p class="text-red">{{ $errors->first('reporting_date') }}</p> </span>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group ">

                                        <label for="fname"
                                               class="text-end control-label col-form-label">Reporting Time</label>
                                        <input type="time" class="form-control reporting_time"
                                               name="reporting_time"
                                               placeholder="Enter registration time"
                                               value="{{ date('H:i',strtotime($patient->reporting_date)) }}">
                                        @if ($errors->has('reporting_time'))
                                            <span class="help-block">
                                            <p class="text-red">{{ $errors->first('reporting_time') }}</p> </span>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group ">

                                        <label for="fname"
                                               class="text-end control-label col-form-label">Ref. Doctor</label>
                                        <input type="text" class="form-control" id="ref_doctor"
                                               name="ref_doctor"
                                               placeholder="Enter reference doctor name"
                                               value="{{ (!empty(old('ref_doctor'))) ? old('ref_doctor'): $patient->ref_doctor }}">
                                        @if ($errors->has('ref_doctor'))
                                            <span class="help-block">
                                            <p class="text-red">{{ $errors->first('ref_doctor') }}</p> </span>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group ">

                                        <label for="testname"
                                               class="text-end control-label col-form-label">Test Name</label>
                                        <input type="text" class="form-control" id="test_name"
                                               name="test_name"
                                               placeholder="Enter test name"
                                               value="{{ (!empty(old('test_name'))) ? old('test_name'): $patient->test_name }}">
                                        @if ($errors->has('test_name'))
                                            <span class="help-block">
                                            <p
                                                class="text-red">{{ $errors->first('test_name') }}</p> </span>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group ">

                                        <label for="testname"
                                               class="text-end control-label col-form-label">Detection Status</label>
                                        <select name="detection_status" id="detection_status" class="form-control">
                                            <option value="" disabled selected>Select Detection Status</option>
                                            <option value="Detected"
                                                    @if($patient->detection_status == 'Detected') selected="" @endif>
                                                Positive
                                            </option>
                                            <option value="Not Detected"
                                                    @if($patient->detection_status == 'Not Detected') selected="" @endif>
                                                Negative
                                            </option>
                                            = </select>
                                        @if ($errors->has('detection_status'))
                                            <span class="help-block">
                                            <p
                                                class="text-red">{{ $errors->first('detection_status') }}</p> </span>
                                        @endif

                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group ">

                                        <label for="testname"
                                               class="text-end control-label col-form-label">Reference Range</label>
                                        <input type="text" name="reference_range" class="form-control"
                                               value="{{ (!empty(old('reference_range'))) ? old('reference_range'): $patient->reference_range }}">
                                        @if ($errors->has('reference_range'))
                                            <span class="help-block">
                                            <p
                                                class="text-red">{{ $errors->first('reference_range') }}</p> </span>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group ">

                                        <label for="testname"
                                               class="text-end control-label col-form-label">Location</label>
                                        <input type="text" name="location" class="form-control"
                                               value="{{ (!empty(old('location'))) ? old('location'): $patient->location }}">
                                        @if ($errors->has('location'))
                                            <span class="help-block">
                                            <p
                                                class="text-red">{{ $errors->first('location') }}</p> </span>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group ">

                                        <label for="testname"
                                               class="text-end control-label col-form-label">Methodology</label>
                                        <input type="text" name="methodology" class="form-control"
                                               value="{{ (!empty(old('methodology'))) ? old('methodology'): $patient->methodology }}">
                                        @if ($errors->has('methodology'))
                                            <span class="help-block">
                                            <p
                                                class="text-red">{{ $errors->first('methodology') }}</p> </span>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group ">

                                        <label
                                            class="text-end control-label col-form-label">lab Manager Signature</label>
                                        <input type="file" class="form-control" id="lab_manager_signature"
                                               name="lab_manager_signature"
                                               placeholder="Enter test name" value="{{ old('lab_manager_signature') }}">
                                        <img src="{{ asset('uploads/lab/'.$patient->lab_manager_signature) }}"
                                             style="width: 100px; height: 50px;margin-top: 15px;" alt="">
                                        @if ($errors->has('lab_manager_signature'))
                                            <span class="help-block">
                                            <p
                                                class="text-red">{{ $errors->first('lab_manager_signature') }}</p> </span>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group ">

                                        <label
                                            class="text-end control-label col-form-label">Lab Director Signature</label>
                                        <input type="file" class="form-control" id="lab_director_signature"
                                               name="lab_director_signature"
                                               placeholder="Enter test name"
                                               value="{{ old('lab_director_signature') }}">
                                        <img src="{{ asset('uploads/lab/'.$patient->lab_director_signature) }}"
                                             style="width: 100px; height: 50px;margin-top: 15px;" alt="">

                                        @if ($errors->has('lab_director_signature'))
                                            <span class="help-block">
                                            <p
                                                class="text-red">{{ $errors->first('lab_director_signature') }}</p> </span>
                                        @endif

                                    </div>
                                </div>


                            </div>
                        </div>

                        <div class="card-body">

                            <button type="submit" class="btn btn-primary">
                                Update Patient
                            </button>
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

    @push('extra-css')
        <link href="{{ asset('backend/assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}"
              rel="stylesheet">
    @endpush
    @push('extra-script')

        <script src="{{ asset('backend/assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
        <script>
            $('#date_of_birth input, ' +
                '#reporting_date input, ' +
                '#registration_date input, ' +
                '#collection_date input').datepicker({
                todayBtn: true,
                autoclose: true,
                todayHighlight: true
            });
        </script>
    @endpush
@endsection
