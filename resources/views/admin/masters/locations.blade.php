<x-admin.layout>
    <x-slot name="title" >Locations</x-slot>
    <x-slot name="breadcrumb">Locations</x-slot>

    <!-- Add Form -->
    <div class="row" id="addContainer" style="display:none;">
        <div class="col-sm-12">
            <div class="card">
                <h2 class="fs-lg fw-medium me-auto" style="margin: 15px">Add Location</h2>
                <form class="theme-form" name="addForm" id="addForm" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">
                        <div class="mb-3 row">

                            <div class="col-md-4">
                                <label class="col-form-label" for="name">Select Ward<span class="text-danger">*</span></label>
                                <select class="form-control" id="ward" name="ward_id">
                                    <option value="">Select Ward</option>
                                    @foreach ($wards as $ward)
                                        <option value="{{ $ward->id }}">{{ $ward->name }}</option>
                                    @endforeach
                                </select>
                                <span class="pristine-error text-theme-6 mt-1 name_err"></span>
                            </div>

                            <div class="col-md-4">
                                <label class="col-form-label" for="location"> Location <span class="text-danger">*</span></label>
                                <input class="form-control" name="location" type="text" placeholder="Enter Location">
                                <span class="pristine-error text-theme-6 mt-1 location_err"></span>
                            </div>

                            <div class="col-md-4">
                                <label class="col-form-label" for="description"> Description <span class="text-danger">*</span></label>
                                <textarea name="description" class="form-control"></textarea>
                                <span class="pristine-error text-theme-6 mt-1 des_err"></span>
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
                    <h2 class="fs-lg fw-medium me-auto" style="margin: 15px">Edit Location</h2>

                    <div class="card-body py-2">

                        <input type="hidden" id="edit_model_id" name="edit_model_id" value="">
                        <div class="mb-3 row">

                            <div class="col-md-4">
                                <label class="col-form-label" for="name">Select Ward<span class="text-danger">*</span></label>
                                <select class="form-control" id="edit_ward" name="ward_id">
                                    <option value="">Select Ward</option>
                                    @foreach ($wards as $ward)
                                        <option value="{{ $ward->id }}">{{ $ward->name }}</option>
                                    @endforeach
                                </select>
                                <span class="pristine-error text-theme-6 mt-1 name_err"></span>
                            </div>

                            <div class="col-md-4">
                                <label class="col-form-label" for="location"> Location <span class="text-danger">*</span></label>
                                <input class="form-control" name="location" type="text" placeholder="Enter Location">
                                <span class="pristine-error text-theme-6 mt-1 location_err"></span>
                            </div>

                            <div class="col-md-4">
                                <label class="col-form-label" for="description"> Description <span class="text-danger">*</span></label>
                                <textarea name="description" class="form-control"></textarea>
                                <span class="pristine-error text-theme-6 mt-1 des_err"></span>
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
                            <th>Ward</th>
                            <th>Location</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($locations as $location)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $location?->ward?->name }}</td>
                                <td>{{ $location?->location }}</td>
                                <td>{{ $location?->description }}</td>
                                <td>
                                    <button class="edit-element btn px-2 py-1" title="Edit location" data-id="{{ $location->id }}"><i class="far fa-pen-to-square"></i> &nbsp;Edit</button>
                                    <button class="btn text-danger rem-element px-2 py-1" title="Delete location" data-id="{{ $location->id }}"><i class="far fa-trash-can"></i> &nbsp;Delete</button>
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
                    url: '{{ route('locations.store') }}',
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
                                    window.location.href = '{{ route('locations.index') }}';
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
                var url = "{{ route('locations.edit', ":model_id") }}";

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
                            $("#editForm input[name='edit_model_id']").val(data.location.id);
                            $("#edit_ward").html(data.wardHtml);
                            $("#editForm input[name='location']").val(data.location.location);
                            $("#editForm textarea[name='description']").html(data.location.description);
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
                    var url = "{{ route('locations.update', ":model_id") }}";
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
                                        window.location.href = '{{ route('locations.index') }}';
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
                    title: "Are you sure to delete this Location?",
                    // text: "Make sure if you have filled Vendor details before proceeding further",
                    icon: "info",
                    buttons: ["Cancel", "Confirm"]
                })
                .then((justTransfer) =>
                {
                    if (justTransfer)
                    {
                        var model_id = $(this).attr("data-id");
                        var url = "{{ route('locations.destroy', ":model_id") }}";

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

