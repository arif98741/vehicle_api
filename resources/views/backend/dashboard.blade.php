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
                                <h4 class="card-title">Site Analysis</h4>
                                <h5 class="card-subtitle">Overview of Latest Month</h5>
                            </div>
                        </div>
                        <div class="row">
                            <!-- column -->
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="bg-dark p-10 text-white text-center">
                                            <i class="mdi mdi-view-list fs-3 mb-1 font-16"></i>
                                            <h5 class="mb-0 mt-1">0</h5>
                                            <small class="font-light">Total Orders</small>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="bg-dark p-10 text-white text-center">
                                            <i class="mdi mdi-account fs-3 font-16"></i>
                                            <h5 class="mb-0 mt-1">0</h5>
                                            <small class="font-light">Total Service Providers</small>
                                        </div>
                                    </div>
                                    <div class="col-6 mt-3">
                                        <div class="bg-danger p-10 text-white text-center">
                                            <i class="mdi mdi-account-multiple fs-3 mb-1 font-16"></i>
                                            <h5 class="mb-0 mt-1">0</h5>
                                            <small class="font-light">Total Customer</small>
                                        </div>
                                    </div>
                                    <div class="col-6 mt-3">
                                        <div class="bg-success p-10 text-white text-center">
                                            <i class="mdi mdi-cash-usd fs-3 mb-1 font-16"></i>
                                            <h5 class="mb-0 mt-1">0</h5>
                                            <small class="font-light">Total Earning</small>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="flot-chart">
                                    <div
                                        class="flot-chart-content"
                                        id="flot-line-chart"
                                    ></div>
                                </div>
                            </div>

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
