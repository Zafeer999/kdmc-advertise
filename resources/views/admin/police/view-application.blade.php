<x-admin.layout>
    <x-slot name="title">Documents</x-slot>
    <x-slot name="breadcrumb">View Application</x-slot>

    {{-- View Application Form --}}
    <div class="intro-y box p-5 mt-5">
        <div class="row" id="editContainer">
            <div class="col">
                <form class="form-horizontal form-bordered" method="post">
                    @csrf
                    <div class="card">
                        <h2 class="fs-lg fw-medium me-auto" style="margin: 15px">View Application</h2>

                        <div class="card-body py-2">

                            <div class="mb-3 row">

                                <div class="col-md-4">
                                    <label class="col-form-label pt-3 pb-0" for="full_name">Applicant/Orgnization Full Name <span class="text-danger">*</span></label>
                                    <input class="form-control" name="full_name" type="text" placeholder="Enter Applicant/Orgnization Full Name" value="{{ $data->full_name }}" readonly>
                                    <span class="pristine-error text-theme-6 mt-1 full_name_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label pt-3 pb-0" for="building_name"> Flat, House no., Building, Company, Apartment <span class="text-danger">*</span></label>
                                    <input class="form-control" name="building_name" type="text" placeholder="Enter Flat,House no.,Building,Company,Apartment" value="{{ $data->building_name }}" readonly>
                                    <span class="pristine-error text-theme-6 mt-1 building_name_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label pt-3 pb-0" for="area"> Area, Street, Sector <span class="text-danger">*</span></label>
                                    <input class="form-control" name="area" type="text" placeholder="Enter Area, Street, Sector" value="{{ $data->area }}" readonly>
                                    <span class="pristine-error text-theme-6 mt-1 area_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label pt-3 pb-0" for="landmark"> Landmark <span class="text-danger">*</span></label>
                                    <input class="form-control" name="landmark" type="text" placeholder="Enter Landmark" value="{{ $data->landmark }}" readonly>
                                    <span class="pristine-error text-theme-6 mt-1 landmark_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label pt-3 pb-0" for="city"> City <span class="text-danger">*</span></label>
                                    <input class="form-control" name="city" type="text" placeholder="Enter City" value="Kalyan" readonly>
                                    <span class="pristine-error text-theme-6 mt-1 city_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label pt-3 pb-0" for="pincode"> Pincode <span class="text-danger">*</span></label>
                                    <input class="form-control" name="pincode" type="text" placeholder="Enter Pincode" value="{{ $data->pincode }}" readonly>
                                    <span class="pristine-error text-theme-6 mt-1 pincode_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label pt-3 pb-0" for="contact_no"> Mobile No. <span class="text-danger">*</span></label>
                                    <input class="form-control" name="contact_no" type="text" placeholder="Enter Applicant Contact No." value="{{ $data->contact_no }}" readonly>
                                    <span class="pristine-error text-theme-6 mt-1 contact_no_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label pt-3 pb-0" for="alternate_contact_no">Alternate Mobile No.</label>
                                    <input class="form-control" name="alternate_contact_no" type="text" placeholder="Enter Applicant Alternate Mobile No." value="{{ $data->alternate_contact_no }}" readonly>
                                    <span class="pristine-error text-theme-6 mt-1 alternate_contact_no_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label pt-3 pb-0" for="aadhar_card_no"> Aadhar Card No. <span class="text-danger">*</span></label>
                                    <input class="form-control" name="aadhar_card_no" type="text" placeholder="Enter Aadhar Card No." value="{{ $data->aadhar_card_no }}" readonly>
                                    <span class="pristine-error text-theme-6 mt-1 aadhar_card_no_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label pt-3 pb-0" for="advertise_type"> Type of Advertise <span class="text-danger">*</span></label>
                                    <select name="advertise_type" id="advertise_type" class="form-control" disabled>
                                        <option value="">Please Select Type of Advertise</option>
                                        <option value="Cloth" {{ $data->advertise_type == 'Cloth' ? 'Selected' : '' }}>cloth</option>
                                        <option value="Banners" {{ $data->advertise_type == 'Banners' ? 'Selected' : '' }}>Banner</option>
                                        <option value="Hoardings" {{ $data->advertise_type == 'Hoardings' ? 'Selected' : '' }}>hoardings</option>
                                        <option value="Poster" {{ $data->advertise_type == 'Poster' ? 'Selected' : '' }}>poster</option>
                                        <option value="Kamani" {{ $data->advertise_type == 'Kamani' ? 'Selected' : '' }}>kamani</option>

                                    </select>
                                    <span class="pristine-error text-theme-6 mt-1 advertise_type_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label pt-3 pb-0" for="ward"> Ward <span class="text-danger">*</span></label>
                                    <input class="form-control" name="ward" type="text" value="{{ $data->ward?->name }}" readonly>
                                    <span class="pristine-error text-theme-6 mt-1 ward_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label pt-3 pb-0" for="from_date"> From Date <span class="text-danger">*</span></label>
                                    <input class="form-control" name="from_date" type="text" value="{{ $data?->from_date }}" readonly>
                                    <span class="pristine-error text-theme-6 mt-1 ward_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label pt-3 pb-0" for="to_date"> To Date <span class="text-danger">*</span></label>
                                    <input class="form-control" name="to_date" type="text" value="{{ $data?->to_date }}" readonly>
                                    <span class="pristine-error text-theme-6 mt-1 ward_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label pt-3 pb-0" for="days"> Days <span class="text-danger">*</span></label>
                                    <input class="form-control" name="days" type="number" value="{{ $data->days }}" readonly>
                                    <span class="pristine-error text-theme-6 mt-1 days_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label pt-3 pb-0" for="length"> Length <span class="text-danger">*</span></label>
                                    <input class="form-control" name="length" type="number" value="{{ $data->length }}" readonly>
                                    <span class="pristine-error text-theme-6 mt-1 length_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label pt-3 pb-0" for="width"> Width <span class="text-danger">*</span></label>
                                    <input class="form-control" name="width" type="number" value="{{ $data->width }}" readonly>
                                    <span class="pristine-error text-theme-6 mt-1 width_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label pt-3 pb-0" for="amount"> Fees Amount <span class="text-danger">*</span></label>
                                    <input class="form-control" name="amount" type="text" value="{{ $data->price }}" readonly>
                                    <span class="pristine-error text-theme-6 mt-1 ward_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label pt-3 pb-0" for="advertise_detail"> Details in Advertise <span class="text-danger">*</span></label>
                                    <textarea name="advertise_detail" class="form-control" cols="10" rows="4" style="max-height: 100px; min-height: 100px" readonly>{{ $data?->advertise_detail }}</textarea>
                                    <span class="pristine-error text-theme-6 mt-1 advertise_detail_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label pt-3 pb-0" for="location"> Location <span class="text-danger">*</span></label>
                                    <textarea name="location" class="form-control" cols="10" rows="4" style="max-height: 100px; min-height: 100px" readonly>{{ $data->location }}</textarea>
                                    <span class="pristine-error text-theme-6 mt-1 location_err"></span>
                                </div>

                                <div class="col-md-4 zoom-in">
                                    <label class="col-form-label pt-3 pb-0" for="advertise_detail"> View Banner Image <span class="text-danger">*</span></label>
                                    <a href="{{ asset($data?->banner_image) }}" target="blank">
                                        <div class="h-40 h-xxl-56 image-fit">
                                            <img alt="Rubick Bootstrap HTML Admin Template" class="rounded-2" src="{{ asset($data?->banner_image) }}">
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <hr>
                            <hr>
                            <hr>
                            <div class="mb-3 row">
                                <h2 class="fs-lg fw-medium me-auto" style="margin: 15px 0">Uploaded Documents</h2>
                                @foreach ($documents as $res)
                                    <div class="col-md-3 zoom-in">
                                        <label class="col-form-label" for="banner_img"> Uploaded {{ $res->document->name }} <span class="text-danger">{{ $res->document->is_required == 1 ? '*' : '' }}</span></label>
                                        <a href="{{ asset($res->path) }}" target="blank" class="btn btn-primary form-control">View {{ $res->document->name }}</a>
                                        <span class="pristine-error text-theme-6 mt-1 banner_img_err"></span>
                                    </div>
                                @endforeach
                            </div>

                        </div>

                        <div class="card-footer">
                            @if(($data->status == 0 || auth()->user()->hasRole(['Police'])) && !auth()->user()->hasRole(['User']) )
                                <button type="button" class="approve btn btn-primary" data-id="{{ $data->id }}"><i class="far fa-pen-to-square"></i> &nbsp;Approve</button>
                                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#medium-modal-size-preview" class="btn btn-primary me-1 mb-2"><i class="fa fa-times-circle" aria-hidden="true"></i> &nbsp; Reject </a>
                            @endif
                            <a href="javascript::void(0)" onclick="goToPreviousPage()" type="button" class="btn btn-dark">Back</a>
                        </div>
                    </div>
                </form>
            </div>
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
                                <div class="modal-body p-10 text-center">
                                    <h2 class="fs-lg fw-medium me-auto" style="margin: 15px 0">Reject Reason Form</h2>

                                    <input type="hidden" id="edit_model_id" name="edit_model_id" value="{{ $data->id }}">
                                    <div class="col-md-12">
                                        <label class="col-form-label pt-3 pb-0" for="reject_remark"> Enter Remark of Reject <span class="text-danger">*</span></label>
                                        <textarea name="reject_remark" class="form-control" required></textarea>
                                        <span class="pristine-error text-theme-6 mt-1 reject_remark_err"></span>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="card-footer">
                                        <button class="btn btn-primary" id="rejectSubmit">Submit</button>
                                        <button type="reset" class="btn btn-warning">Reset</button>
                                    </div>
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
            $(".approve").on("click", function(e) {
                e.preventDefault();

                var model_id = $(this).attr("data-id");
                var url = "{{ route('approve-application', ":model_id") }}";

                $.ajax({
                    url: url.replace(':model_id', model_id),
                    type: 'GET',
                    data: {
                        '_token': "{{ csrf_token() }}"
                    },
                    success: function(data)
                        {
                            $("#editSubmit").prop('disabled', false);
                            if (!data.error2)
                                swal("Successful!", data.success, "success")
                                    .then((action) => {
                                        window.location.href = '{{ route('permission-requests') }}';
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
        </script>

        {{-- Add Reject Remark --}}
        <script>
            $("#editForm").submit(function(e) {
                e.preventDefault();
                $("#rejectSubmit").prop('disabled', true);
                var formdata = new FormData(this);
                formdata.append('_method', 'PUT');
                var model_id = $('#edit_model_id').val();
                var url = "{{ route('reject-application', ':model_id') }}";
                //
                $.ajax({
                    url: url.replace(':model_id', model_id),
                    type: 'POST',
                    data: formdata,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $("#rejectSubmit").prop('disabled', false);
                        if (!data.error2)
                            swal("Successful!", data.success, "success")
                            .then((action) => {
                                window.location.href = '{{ route('permission-requests') }}';
                            });
                        else
                            swal("Error!", data.error2, "error");
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

        <script>
            function goToPreviousPage() {
                window.history.back();
            }
        </script>
    @endpush

</x-admin.layout>
