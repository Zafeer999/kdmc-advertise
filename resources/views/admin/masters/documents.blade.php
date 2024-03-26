<x-admin.layout>
    <x-slot name="title" >Documents</x-slot>
    <x-slot name="breadcrumb">Documents</x-slot>



    <!-- Add Form -->
    <div class="row" id="addContainer" style="display:none;">
        <div class="col-sm-12">
            <div class="card">
                <h2 class="fs-lg fw-medium me-auto" style="margin: 15px">Add Document</h2>
                <form class="theme-form" name="addForm" id="addForm" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">
                        <div class="mb-3 row">

                            <div class="col-md-4">
                                <label class="col-form-label" for="name">Document <span class="text-danger">*</span></label>
                                <input class="form-control" name="name" type="text" placeholder="Enter Ward Name">
                                <span class="pristine-error text-theme-6 mt-1 name_err"></span>
                            </div>

                            <div class="col-md-4">
                                <label class="col-form-label" for="initial"> Document Initial <span class="text-danger">*</span></label>
                                <input class="form-control" name="initial" type="text" placeholder="Enter Ward Initial">
                                <span class="pristine-error text-theme-6 mt-1 initial_err"></span>
                            </div>

                            <div class="col-md-4">
                                <label class="col-form-label" for="is_required"> Is Required Document <span class="text-danger">*</span></label>
                                <select name="is_required" id="is_required" class="form-control">
                                    <option value="1">Mandatory</option>
                                    <option value="0">Not Mandatory</option>
                                </select>

                                <span class="pristine-error text-theme-6 mt-1 is_required_err"></span>
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
                    <h2 class="fs-lg fw-medium me-auto" style="margin: 15px">Edit Document</h2>

                    <div class="card-body py-2">

                        <input type="hidden" id="edit_model_id" name="edit_model_id" value="">
                        <div class="mb-3 row">

                            <div class="col-md-4">
                                <label class="col-form-label" for="name">Document <span class="text-danger">*</span></label>
                                <input class="form-control" name="name" type="text" placeholder="Enter Ward Name">
                                <span class="pristine-error text-theme-6 mt-1 name_err"></span>
                            </div>

                            <div class="col-md-4">
                                <label class="col-form-label" for="initial"> Document Initial <span class="text-danger">*</span></label>
                                <input class="form-control" name="initial" type="text" placeholder="Enter Ward Initial">
                                <span class="pristine-error text-theme-6 mt-1 initial_err"></span>
                            </div>

                            <div class="col-md-4">
                                <label class="col-form-label" for="is_required"> Is Required Document <span class="text-danger">*</span></label>
                                <select name="is_required" id="edit_is_required" class="form-control">
                                    <option value="1">Mandatory</option>
                                    <option value="0">Not Mandatory</option>
                                </select>

                                <span class="pristine-error text-theme-6 mt-1 is_required_err"></span>
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
                            <th>Name</th>
                            <th>Initial</th>
                            <th>Is Mandatory</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($documents as $document)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $document->name }}</td>
                                <td>{{ $document->initial }}</td>
                                <td>{{ ($document->is_required == 1) ? 'Mandatory':'Not Mandatory' }}</td>
                                <td>
                                    <button class="edit-element btn px-2 py-1" title="Edit documents" data-id="{{ $document->id }}"><i class="far fa-pen-to-square"></i> &nbsp;Edit</button>
                                    <button class="btn text-danger rem-element px-2 py-1" title="Delete documents" data-id="{{ $document->id }}"><i class="far fa-trash-can"></i> &nbsp;Delete</button>
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
                    url: '{{ route('documents.store') }}',
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
                                    window.location.href = '{{ route('documents.index') }}';
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
                var url = "{{ route('documents.edit', ":model_id") }}";

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
                            $("#editForm input[name='edit_model_id']").val(data.document.id);
                            $("#editForm input[name='name']").val(data.document.name);
                            $("#editForm input[name='initial']").val(data.document.initial);
                            // $("#edit_is_required").html(data.isRequiredHtml);
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
                    var url = "{{ route('documents.update', ":model_id") }}";
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
                                        window.location.href = '{{ route('documents.index') }}';
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
                    title: "Are you sure to delete this ward?",
                    // text: "Make sure if you have filled Vendor details before proceeding further",
                    icon: "info",
                    buttons: ["Cancel", "Confirm"]
                })
                .then((justTransfer) =>
                {
                    if (justTransfer)
                    {
                        var model_id = $(this).attr("data-id");
                        var url = "{{ route('documents.destroy', ":model_id") }}";

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

