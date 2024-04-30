<x-admin.layout>
    <x-slot name="title" >Users</x-slot>
    <x-slot name="breadcrumb">Users</x-slot>



    <!-- Add Form -->
    <div class="row" id="addContainer" style="display:none;">
        <div class="col-sm-12">
            <div class="card">
                <h2 class="fs-lg fw-medium me-auto" style="margin: 15px">Add User</h2>
                <form class="theme-form" name="addForm" id="addForm" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">
                        <div class="mb-3 row">

                            <div class="col-md-4">
                                <label class="col-form-label" for="name">Full Name <span class="text-danger">*</span></label>
                                <input class="form-control" name="name" type="text" placeholder="Enter Full Name">
                                <span class="pristine-error text-theme-6 mt-1 name_err"></span>
                            </div>

                            <div class="col-md-4">
                                <label class="col-form-label" for="user_type">User Type<span class="text-danger">*</span></label>
                                <select class="tom-select user-type" id="user_type" name="user_type">
                                    <option value="">Select User Type</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                <span class="pristine-error text-theme-6 mt-1 user_type_err"></span>
                            </div>

                            <div class="col-md-4 ward_div" style="display: none;">
                                <label class="col-form-label" for="name">Select Ward<span class="text-danger">*</span></label>
                                <select class="tom-select" id="ward" name="ward_id">
                                    <option value="">Select Ward</option>
                                    @foreach ($wards as $ward)
                                        <option value="{{ $ward->id }}">{{ $ward->name }}</option>
                                    @endforeach
                                </select>
                                <span class="pristine-error text-theme-6 mt-1 ward_id_err"></span>
                            </div>

                            <div class="col-md-4 police_div" style="display: none;">
                                <label class="col-form-label" for="name">Select Police Station<span class="text-danger">*</span></label>
                                <select class="tom-select" id="police_station" name="police_station_id">
                                    <option value="">Select Police Station</option>
                                    @foreach ($police_stations as $police_station)
                                        <option value="{{ $police_station->id }}">{{ $police_station->police_station }}</option>
                                    @endforeach
                                </select>
                                <span class="pristine-error text-theme-6 mt-1 police_station_id_err"></span>
                            </div>

                            <div class="col-md-4">
                                <label class="col-form-label" for="mobile">Contact No. <span class="text-danger">*</span></label>
                                <input class="form-control" name="mobile" type="text" placeholder="Enter Contact Number">
                                <span class="pristine-error text-theme-6 mt-1 mobile_err"></span>
                            </div>

                            <div class="col-md-4">
                                <label class="col-form-label" for="email">Email/Username <span class="text-danger">*</span></label>
                                <input class="form-control" name="email" type="email" placeholder="Enter Email">
                                <span class="pristine-error text-theme-6 mt-1 email_err"></span>
                            </div>

                            <div class="col-md-4">
                                <label class="col-form-label" for="password">Password <span class="text-danger">*</span></label>
                                <input class="form-control" name="password" type="text" placeholder="Enter Password">
                                <span class="pristine-error text-theme-6 mt-1 password_err"></span>
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
                    <h2 class="fs-lg fw-medium me-auto" style="margin: 15px">Edit User</h2>

                    <div class="card-body py-2">

                        <input type="hidden" id="edit_model_id" name="edit_model_id" value="">
                        <div class="mb-3 row">

                            <div class="col-md-4">
                                <label class="col-form-label" for="name">Full Name <span class="text-danger">*</span></label>
                                <input class="form-control" name="name" type="text" placeholder="Enter Full Name">
                                <span class="pristine-error text-theme-6 mt-1 name_err"></span>
                            </div>

                            <div class="col-md-4">
                                <label class="col-form-label" for="user_type">User Type<span class="text-danger">*</span></label>
                                <select class="form-control edit-user-type" id="edit_user_type" name="user_type">
                                    <option value="">Select User Type</option>
                                    <option value="1">Superadmin</option>
                                    <option value="2">Ward</option>
                                    <option value="3">Police</option>
                                </select>
                                <span class="pristine-error text-theme-6 mt-1 name_err"></span>
                            </div>

                            <div class="col-md-4 ward_div" style="display: none;">
                                <label class="col-form-label" for="name">Select Ward<span class="text-danger">*</span></label>
                                <select class="form-control" id="edit_ward" name="ward_id">
                                    <option value="">Select Ward</option>
                                    @foreach ($wards as $ward)
                                        <option value="{{ $ward->id }}">{{ $ward->name }}</option>
                                    @endforeach
                                </select>
                                <span class="pristine-error text-theme-6 mt-1 name_err"></span>
                            </div>

                            <div class="col-md-4 police_div" style="display: none;">
                                <label class="col-form-label" for="name">Select Police Station<span class="text-danger">*</span></label>
                                <select class="form-control" id="edit_police_station" name="police_station_id">
                                    <option value="">Select Police Station</option>
                                    @foreach ($police_stations as $police_station)
                                        <option value="{{ $police_station->id }}">{{ $police_station->police_station }}</option>
                                    @endforeach
                                </select>
                                <span class="pristine-error text-theme-6 mt-1 police_station_err"></span>
                            </div>

                            <div class="col-md-4">
                                <label class="col-form-label" for="mobile">Contact No. <span class="text-danger">*</span></label>
                                <input class="form-control" name="mobile" type="text" placeholder="Enter Contact Number">
                                <span class="pristine-error text-theme-6 mt-1 mobile_err"></span>
                            </div>

                            <div class="col-md-4">
                                <label class="col-form-label" for="email">Email/Username <span class="text-danger">*</span></label>
                                <input class="form-control" name="email" type="email" placeholder="Enter Email">
                                <span class="pristine-error text-theme-6 mt-1 email_err"></span>
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
                            <th>Full Name</th>
                            <th>Ward</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->ward?->name }}</td>
                                <td>{{ $user->mobile }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->roles[0]->name }}</td>
                                <td>
                                    <button class="edit-element btn px-2 py-1" title="Edit user" data-id="{{ $user->id }}"><i class="far fa-pen-to-square"></i> &nbsp;Edit</button>
                                    <button class="btn text-danger rem-element px-2 py-1" title="Delete user" data-id="{{ $user->id }}"><i class="far fa-trash-can"></i> &nbsp;Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


    </div>
    @push('scripts')

        {{-- On change User Type --}}
        <script>
            $(".user-type").change(function(){
                var user_type = $('.user-type').val();
                if(user_type == 4){ $('.ward_div').show(); $('.police_div').css("display","none");}
                else if(user_type == 3){$('.police_div').show();$('.ward_div').css("display","none");}
                else{$('.ward_div').css("display","none");$('.police_div').css("display","none");}
            });
        </script>

        <script>
            $(".edit-user-type").change(function(){
                var user_type = $('.edit-user-type').val();
                if(user_type == 4){ $('.ward_div').show(); $('.police_div').css("display","none");}
                else if(user_type == 3){$('.police_div').show();$('.ward_div').css("display","none");}
                else{$('.ward_div').css("display","none");$('.police_div').css("display","none");}
            });
        </script>

        {{-- Add --}}
        <script>
            $("#addForm").submit(function(e) {
                e.preventDefault();
                $("#addSubmit").prop('disabled', true);

                var formdata = new FormData(this);
                $.ajax({
                    url: '{{ route('users.store') }}',
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
                                    window.location.href = '{{ route('users.index') }}';
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
                var url = "{{ route('users.edit', ":model_id") }}";

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
                            $("#editForm input[name='edit_model_id']").val(data.user.id);
                            $("#editForm input[name='name']").val(data.user.name);
                            $("#editForm input[name='mobile']").val(data.user.mobile);
                            $("#editForm input[name='email']").val(data.user.email);

                            $("#edit_ward").html(data.wardHtml);
                            $("#edit_police_station").html(data.policeHtml);
                            $("#edit_user_type").html(data.userTypeHtml);

                            if(data.userRole.id == 3)
                            {
                                $('.police_div').show();
                            }
                            else if(data.userRole.id == 4)
                            {
                                $('.ward_div').show();
                            }
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
                    var url = "{{ route('users.update', ":model_id") }}";
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
                                        window.location.href = '{{ route('users.index') }}';
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
                    title: "Are you sure to delete this User?",
                    // text: "Make sure if you have filled Vendor details before proceeding further",
                    icon: "info",
                    buttons: ["Cancel", "Confirm"]
                })
                .then((justTransfer) =>
                {
                    if (justTransfer)
                    {
                        var model_id = $(this).attr("data-id");
                        var url = "{{ route('users.destroy', ":model_id") }}";

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

