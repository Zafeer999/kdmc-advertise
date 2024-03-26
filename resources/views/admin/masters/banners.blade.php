<x-admin.layout>
    <x-slot name="title" >Banner Details</x-slot>
    <x-slot name="breadcrumb">Banner Details</x-slot>

    <!-- Add Form -->
    <div class="row" id="addContainer" style="display:none;">
        <div class="col-sm-12">
            <div class="card">
                <h2 class="fs-lg fw-medium me-auto" style="margin: 15px">Add Banner Details</h2>
                <form class="theme-form" name="addForm" id="addForm" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">
                        <div class="mb-3 row">

                            <div class="col-md-4">
                                <label class="col-form-label" for="banner_size"> Banner Size <span class="text-danger">*</span></label>
                                <input class="form-control" name="banner_size" type="text" placeholder="Enter Banner Size">
                                <span class="pristine-error text-theme-6 mt-1 banner_size_err"></span>
                            </div>

                            <div class="col-md-4">
                                <label class="col-form-label" for="amount"> Fees <span class="text-danger">*</span></label>
                                <input class="form-control" name="amount" type="text" placeholder="Enter Fees">
                                <span class="pristine-error text-theme-6 mt-1 amount_err"></span>
                            </div>

                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" id="addSubmit">Submit</button>
                        <button type="reset" class="btn btn-warning">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Edit Form --}}
    <div class="row" id="editContainer" style="display:none;">
        <div class="col">
            <form class="form-horizontal form-bordered" method="post" id="editForm">
                @csrf
                <section class="card">
                    <h2 class="fs-lg fw-medium me-auto" style="margin: 15px">Edit Banner Details</h2>

                    <div class="card-body py-2">

                        <input type="hidden" id="edit_model_id" name="edit_model_id" value="">
                        <div class="mb-3 row">

                            <div class="col-md-4">
                                <label class="col-form-label" for="banner_size"> Banner Size <span class="text-danger">*</span></label>
                                <input class="form-control" name="banner_size" type="text" placeholder="Enter Banner Size">
                                <span class="pristine-error text-theme-6 mt-1 banner_size_err"></span>
                            </div>

                            <div class="col-md-4">
                                <label class="col-form-label" for="amount"> Fees <span class="text-danger">*</span></label>
                                <input class="form-control" name="amount" type="text" placeholder="Enter Fees">
                                <span class="pristine-error text-theme-6 mt-1 amount_err"></span>
                            </div>

                        </div>

                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary" id="editSubmit">Submit</button>
                        <button type="reset" class="btn btn-warning">Reset</button>
                    </div>
                </section>
            </form>
        </div>
    </div>

    <div class="intro-y box p-5 mt-5">
        <div class="d-flex flex-column flex-sm-row align-items-sm-end align-items-xl-start mb-3">
            <div class="row">
                <div class="col-sm-6">
                    <div class="d-flex">
                        <button id="addToTable" class="btn btn-primary me-2 px-5"><i class="fa fa-plus"></i> &nbsp;Add</button>
                        <button id="btnCancel" class="btn btn-danger ms-2 px-5" style="display:none;">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto scrollbar-hidden">
            <div class="table-responsive">
                <table class="table-bordered" id="datatable-tabletools">
                    <thead>
                        <tr>
                            <th>Sr No</th>
                            <th>Banner Size</th>
                            <th>Fee</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($banners as $banner)
                        <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $banner?->banner_size }}</td>
                                <td>{{ $banner?->amount }}</td>
                                <td>
                                    <button class="edit-element btn px-2 py-1" title="Edit banner" data-id="{{ $banner->id }}"><i class="far fa-pen-to-square"></i> &nbsp;Edit</button>
                                    <button class="btn text-danger rem-element px-2 py-1" title="Delete banner" data-id="{{ $banner->id }}"><i class="far fa-trash-can"></i> &nbsp;Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


    </div>
    @push('scripts')


        {{-- Add --}}
        <script>
            $("#addForm").submit(function(e) {
                e.preventDefault();
                $("#addSubmit").prop('disabled', true);

                var formdata = new FormData(this);
                $.ajax({
                    url: '{{ route('banners.store') }}',
                    type: 'POST',
                    data: formdata,
                    contentType: false,
                    processData: false,
                    success: function(data)
                    {
                        $("#addSubmit").prop('disabled', false);
                        if (!data.error2)
                            swal("Successful!", data.success, "success")
                                .then((action) => {
                                    window.location.href = '{{ route('banners.index') }}';
                                });
                        else
                            swal("Error!", data.error2, "error");
                    },
                    statusCode: {
                        422: function(responseObject, textStatus, jqXHR) {
                            $("#addSubmit").prop('disabled', false);
                            resetErrors();
                            printErrMsg(responseObject.responseJSON.errors);
                        },
                        500: function(responseObject, textStatus, errorThrown) {
                            $("#addSubmit").prop('disabled', false);
                            swal("Error occured!", "Something went wrong please try again", "error");
                        }
                    }
                });

            });
        </script>


        <!-- Edit -->
        <script>
            $("#datatable-tabletools").on("click", ".edit-element", function(e) {
                e.preventDefault();
                $(".edit-element").show();
                var model_id = $(this).attr("data-id");
                var url = "{{ route('banners.edit', ":model_id") }}";

                $.ajax({
                    url: url.replace(':model_id', model_id),
                    type: 'GET',
                    data: {
                        '_token': "{{ csrf_token() }}"
                    },
                    success: function(data, textStatus, jqXHR) {
                        editFormBehaviour();

                        if (!data.error)
                        {
                            $("#editForm input[name='edit_model_id']").val(data.banner.id);
                            $("#editForm input[name='banner_size']").val(data.banner.banner_size);
                            $("#editForm input[name='amount']").val(data.banner.amount);
                        }
                        else
                        {
                            alert(data.error);
                        }
                    },
                    error: function(error, jqXHR, textStatus, errorThrown) {
                        alert("Some thing went wrong");
                    },
                });
            });
        </script>


         <!-- Update -->
         <script>
            $(document).ready(function() {
                $("#editForm").submit(function(e) {
                    e.preventDefault();
                    $("#editSubmit").prop('disabled', true);
                    var formdata = new FormData(this);
                    formdata.append('_method', 'PUT');
                    var model_id = $('#edit_model_id').val();
                    var url = "{{ route('banners.update', ":model_id") }}";
                    //
                    $.ajax({
                        url: url.replace(':model_id', model_id),
                        type: 'POST',
                        data: formdata,
                        contentType: false,
                        processData: false,
                        success: function(data)
                        {
                            $("#editSubmit").prop('disabled', false);
                            if (!data.error2)
                                swal("Successful!", data.success, "success")
                                    .then((action) => {
                                        window.location.href = '{{ route('banners.index') }}';
                                    });
                            else
                                swal("Error!", data.error2, "error");
                        },
                        statusCode: {
                            422: function(responseObject, textStatus, jqXHR) {
                                $("#editSubmit").prop('disabled', false);
                                resetErrors();
                                printErrMsg(responseObject.responseJSON.errors);
                            },
                            500: function(responseObject, textStatus, errorThrown) {
                                $("#editSubmit").prop('disabled', false);
                                swal("Error occured!", "Something went wrong please try again", "error");
                            }
                        }
                    });


                });
            });
        </script>


        <!-- Delete -->
        <script>
            $("#datatable-tabletools").on("click", ".rem-element", function(e) {
                e.preventDefault();
                swal({
                    title: "Are you sure to delete this Banner Details?",
                    // text: "Make sure if you have filled Vendor details before proceeding further",
                    icon: "info",
                    buttons: ["Cancel", "Confirm"]
                })
                .then((justTransfer) =>
                {
                    if (justTransfer)
                    {
                        var model_id = $(this).attr("data-id");
                        var url = "{{ route('banners.destroy', ":model_id") }}";

                        $.ajax({
                            url: url.replace(':model_id', model_id),
                            type: 'POST',
                            data: {
                                '_method': "DELETE",
                                '_token': "{{ csrf_token() }}"
                            },
                            success: function(data, textStatus, jqXHR) {
                                if (!data.error && !data.error2) {
                                    swal("Success!", data.success, "success")
                                        .then((action) => {
                                            window.location.reload();
                                        });
                                } else {
                                    if (data.error) {
                                        swal("Error!", data.error, "error");
                                    } else {
                                        swal("Error!", data.error2, "error");
                                    }
                                }
                            },
                            error: function(error, jqXHR, textStatus, errorThrown) {
                                swal("Error!", "Something went wrong", "error");
                            },
                        });
                    }
                });
            });
        </script>

    @endpush

</x-admin.layout>

