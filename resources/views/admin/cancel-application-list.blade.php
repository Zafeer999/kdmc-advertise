<x-admin.layout>
    <x-slot name="title">Cancel Application List</x-slot>
    <x-slot name="breadcrumb">Cancel Application List</x-slot>

    <div class="intro-y box p-5 mt-5">
        <h2 class="fs-lg fw-medium me-auto" style="margin: 15px 0">
            Cancel Application List
        </h2>
        <div class="overflow-x-auto scrollbar-hidden">
            <div class="table-responsive">
                <table class="table-bordered" id="datatable-tabletools">
                    <thead>
                        <tr>
                            <th>Sr No</th>
                            <th>Application No. </th>
                            <th>Applicant Name </th>
                            <th>Contact</th>
                            <th>Ward</th>
                            <th>Location</th>
                            <th style="min-width:70px;">From Date</th>
                            <th style="min-width:60px;">To Date</th>
                            <th style="min-width:90px;">Banner Size / Amount</th>
                            <th style="min-width:70px;">Advertise Details</th>
                            <th>Banner Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($applications as $application)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $application->application_no }}</td>
                                <td>{{ $application->full_name }}</td>
                                <td>{{ $application->contact_no }}</td>
                                <td>{{ $application->ward?->name }}</td>
                                <td>{{ $application->location }}</td>
                                <td>{{ $application->from_date }}</td>
                                <td>{{ $application->to_date }}</td>
                                <td>{{ $application->banner?->banner_size . ' | ' . $application->banner?->amount }}</td>
                                <td>{{ $application->advertise_detail }}</td>
                                <td>
                                    <a href="{{ asset($application->banner_image) }}" target="_blank" class="btn btn-info">View Banner</a>
                                </td>
                                <td>
                                    <a href="{{ route('view-application', $application->id) }}"><button class="edit-element btn btn-warning me-1 mb-2" title="Edit location"><i class="far fa-pen-to-square"></i> &nbsp;View</button></a>
                                    @if ($application->payment_status == 1)
                                        @if ($application->cancel_date)
                                            <a href="javascript:;" class="edit-element btn btn-info me-1 mb-2">
                                                <i class="fa fa-times-circle" aria-hidden="true"></i> &nbsp;Cancelled
                                            </a>
                                        @else
                                            <a href="javascript:;" data-id="{{ $application->id }}" data-bs-toggle="modal" data-bs-target="#medium-modal-size-preview" class="edit-element btn btn-warning me-1 mb-2">
                                                <i class="fa fa-times-circle" aria-hidden="true"></i> &nbsp;Cancel
                                            </a>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="intro-y box mt-5">
            <div id="modal-size" class="p-5">
                <div class="preview">
                    <div id="medium-modal-size-preview" class="modal fade" tabindex="-1" aria-hidden="true">
                        <form class="form-horizontal form-bordered" method="post" id="editForm">
                            @csrf
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h2 class="modal-title fs-5" id="exampleModalLabel">Cancel Application Form</h2>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                    <div class="modal-body p-10">

                                        <input type="hidden" id="edit_model_id" name="edit_model_id">
                                        <div class="col-md-12">
                                            <label class="col-form-label pt-3 pb-0" for="cancel_remark"> Enter Remark of Cancellation <span class="text-danger">*</span></label>
                                            <textarea name="cancel_remark" class="form-control" required></textarea>
                                            <span class="pristine-error text-theme-6 mt-1 cancel_remark_err"></span>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button class="btn btn-primary" id="rejectSubmit">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @push('scripts')
        <script>
            $(".edit-element").on("click", function(e) {
                var model_id = $(this).attr("data-id");
                $('#edit_model_id').val(model_id);
            });
        </script>

        {{-- Add Cancel Remark --}}
        <script>
            $("#editForm").submit(function(e) {
                e.preventDefault();
                $("#rejectSubmit").prop('disabled', true);
                var formdata = new FormData(this);
                formdata.append('_method', 'PUT');
                var model_id = $('#edit_model_id').val();
                var url = "{{ route('cancel-application', ':model_id') }}";
                //
                $.ajax({
                    url: url.replace(':model_id', model_id),
                    type: 'POST',
                    data: formdata,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $("#rejectSubmit").prop('disabled', false);
                        // var newData = JSON.parse(data);

                        var newData;

                        if (typeof data === 'string') {
                            newData = JSON.parse(data);
                        } else {
                            newData = data;
                        }

                        if (newData.error2)
                        {
                            swal("Error!", newData.error2, "error");
                        }
                        else if(newData.success)
                        {
                            swal("Successful!", newData.success, "success")
                            .then((action) => {
                                window.location.href = '{{ route('cancel-application-list') }}';
                            });
                        }
                        else
                        {
                            swal("Error!", "Failed to initialize refund", "error");
                        }
                    },
                    statusCode: {
                        422: function(responseObject, textStatus, jqXHR) {
                            $("#rejectSubmit").prop('disabled', false);
                            resetErrors();
                            printErrMsg(responseObject.responseJSON.errors);
                        },
                        500: function(responseObject, textStatus, errorThrown) {
                            $("#rejectSubmit").prop('disabled', false);
                            swal("Error occured!", "Something went wrong please try again", "error");
                        }
                    }
                });


            });
        </script>
    @endpush

</x-admin.layout>
