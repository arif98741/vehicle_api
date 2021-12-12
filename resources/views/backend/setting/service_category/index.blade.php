@extends('backend.layout')
@section('title','Service Category List')
@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Service Category List</h4>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Service Category List
                            </li>
                        </ol>
                    </nav>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <button id="addNewBtn"
                                        class="btn btn-primary">Add
                                    New
                                </button>
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
                                    <th>Category Name</th>
                                    <th>Created Date</th>
                                    <th>Updated Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($service_categories as $key=> $service_category)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $service_category->category_name }}</td>

                                        <td>{{ date('d-m-Y',strtotime($service_category->created_at)) }}</td>
                                        <td>{{ date('d-m-Y',strtotime($service_category->updated_at)) }}</td>
                                        <td>
                                            <button class="btn btn-primary editbtn"
                                                    id="{{ $service_category->id }}"><i class="mdi mdi-pencil"></i
                                                ></button>

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

    {{--    modal start--}}
    <div class="modal fade" id="ServiceCategoryAddModal" tabindex="-1" aria-labelledby="ServiceCategoryAddModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="ServiceCategoryAddModalLabel">Add New Service Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Service Category</label>
                        <input type="text" name="category_name" id="category_name" class="form-control"
                               placeholder="Enter new service category">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success actionBtn" id="actionBtn">Save</button>
                </div>
            </div>
        </div>
    </div>
    {{--    modal end--}}




    @push('extra-css')
        <link href="{{ asset('backend/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}"
              rel="stylesheet"/>
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

        <script>

            $(function () {

                /**
                 * save modal data
                 */
                $('#actionBtn').click(function () {
                    let category_name = $('#category_name').val();

                    if ($(this).attr('action') == 'save') { //if save action
                        if (category_name.length == 0) {
                            toastr.warning(
                                "Category name should not be empty"
                            );
                        } else {
                            $.ajax({
                                url: '{{  route('backend.service.service-category.store') }}',
                                headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
                                type: "POST",
                                dataType: "JSON",
                                data: {
                                    category_name: category_name
                                },
                                success: function (res) {

                                    toastr.success(
                                        res.message
                                    );
                                }, error: function (xhr, status, data) {
                                    let errors = xhr.responseJSON.errors;
                                    for (const key in errors) {
                                        if (errors.hasOwnProperty(key)) {

                                            toastr.error(
                                                errors[key]
                                            );
                                        }
                                    }

                                }
                            }).done(function (result) {

                                $('#category_name').val('');
                                $('#ServiceCategoryAddModal').modal('hide');
                                location.reload();
                            });
                        }
                    } else { //if update action
                        let id = $(this).attr('id');

                        /**
                         * update ajax request
                         * @param { id } int
                         * @param { category_name } string
                         */
                        $.ajax({
                            url: '{{  url('backend/service/service-category') }}/' + id,
                            headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
                            type: "PUT",
                            dataType: "JSON",
                            data: {
                                category_name: category_name
                            },
                            success: function (res) {

                                toastr.success(
                                    res.message
                                );
                            }, error: function (xhr, status, data) {
                                let errors = xhr.responseJSON.errors;
                                for (const key in errors) {
                                    if (errors.hasOwnProperty(key)) {

                                        toastr.error(
                                            errors[key]
                                        );
                                    }
                                }

                            }
                        }).done(function (result) {

                            $('#category_name').val('');
                            $('#ServiceCategoryAddModal').modal('hide');
                            location.reload();
                        });
                    }

                });

                /**
                 * add new data
                 */
                $('#addNewBtn').click(function () {

                    $('.actionBtn').text('Save');
                    $('.actionBtn').attr('id', 'savesubcategoryBtn');
                    $('.actionBtn').attr('action', 'save');
                    $('#ServiceCategoryAddModal').modal('show');

                });

                /**
                 * popup edit modal
                 * @param { int } id
                 */
                $('.editbtn').click(function () {
                    let id = $(this).attr('id');
                    $('.actionBtn').attr('action', 'update');
                    $.ajax({
                        url: '{{  url('backend/service/service-category') }}/' + id,
                        dataType: "JSON",
                        success: function (res) {
                            $('#category_name').val(res.data.category_name);
                        }
                    }).done(function (result) {
                        $('.actionBtn').text('Update').attr('id', id);
                        $('#ServiceCategoryAddModal').modal('show');
                    });

                });

            });

        </script>

    @endpush
@endsection
