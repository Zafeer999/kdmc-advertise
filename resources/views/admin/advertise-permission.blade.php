<x-admin.layout>
    <x-slot name="title" >Advertise Permission</x-slot>
    <x-slot name="breadcrumb">Apply for Advertise Permission</x-slot>



    <div class="container my-5">
        <!-- Add Form -->
        <div class="row" id="addContainer">
            <div class="col-sm-12">
                <div class="card">
                    <h2 class="fs-lg fw-medium me-auto" style="margin: 15px">Apply for Advertise Permission</h2>
                    <form class="theme-form" name="addForm" id="addForm" enctype="multipart/form-data">
                        @csrf

                        <div class="card-body">
                            <div class="mb-3 row">
                                <div class="col-md-4">
                                    <label class="col-form-label pt-3 pb-0" for="full_name">Applicant/Orgnization Full Name  <span class="text-danger">*</span></label>
                                    <input class="form-control" name="full_name" type="text" placeholder="Enter Applicant Full Name">
                                    <span class="pristine-error text-theme-6 mt-1 full_name_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label pt-3 pb-0" for="building_name"> Flat, House no., Building, Company, Apartment <span class="text-danger">*</span></label>
                                    <input class="form-control" name="building_name" type="text" placeholder="Enter Flat,House no.,Building,Company,Apartment">
                                    <span class="pristine-error text-theme-6 mt-1 building_name_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label pt-3 pb-0" for="area"> Area, Street, Sector <span class="text-danger">*</span></label>
                                    <input class="form-control" name="area" type="text" placeholder="Enter Area, Street, Sector">
                                    <span class="pristine-error text-theme-6 mt-1 area_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label pt-3 pb-0" for="landmark"> Landmark <span class="text-danger">*</span></label>
                                    <input class="form-control" name="landmark" type="text" placeholder="Enter Landmark">
                                    <span class="pristine-error text-theme-6 mt-1 landmark_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label pt-3 pb-0" for="city"> City <span class="text-danger">*</span></label>
                                    <input class="form-control" name="city" type="text" placeholder="Enter City" value="Kalyan" readonly>
                                    <span class="pristine-error text-theme-6 mt-1 city_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label pt-3 pb-0" for="pincode"> Pincode <span class="text-danger">*</span></label>
                                    <input class="form-control" name="pincode" type="text" placeholder="Enter Pincode">
                                    <span class="pristine-error text-theme-6 mt-1 pincode_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label pt-3 pb-0" for="contact_no"> Mobile No. <span class="text-danger">*</span></label>
                                    <input class="form-control" name="contact_no" type="text" placeholder="Enter Applicant Mobile No.">
                                    <span class="pristine-error text-theme-6 mt-1 contact_no_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label pt-3 pb-0" for="alternate_contact_no">Alternate Mobile No.</label>
                                    <input class="form-control" name="alternate_contact_no" type="text" placeholder="Enter Applicant Alternate Mobile No.">
                                    <span class="pristine-error text-theme-6 mt-1 alternate_contact_no_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label pt-3 pb-0" for="aadhar_card_no"> Aadhar Card No. <span class="text-danger">*</span></label>
                                    <input class="form-control" name="aadhar_card_no" type="text" placeholder="Enter Aadhar Card No.">
                                    <span class="pristine-error text-theme-6 mt-1 aadhar_card_no_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label pt-3 pb-0" for="advertise_type"> Type of Advertise <span class="text-danger">*</span></label>
                                    <select name="advertise_type" id="advertise_type" class="form-control">
                                        <option value="">Please Select Type of Advertise</option>
                                        <option value="Cloth">Cloth</option>
                                        <option value="Banners">Banner</option>
                                        <option value="Hoardings">Hoardings</option>
                                        <option value="Poster">Poster</option>
                                        <option value="Kamani">Kamani</option>
                                    </select>
                                    <span class="pristine-error text-theme-6 mt-1 advertise_type_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label pt-3 pb-0" for="ward_id">Select Ward<span class="text-danger">*</span></label>
                                    <select class="form-control js-example-basic-single" id="ward_id" name="ward_id">
                                        <option value="">Select Ward</option>
                                        @foreach ($wards as $ward)
                                            <option value="{{ $ward->id }}">{{ $ward->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="pristine-error text-theme-6 mt-1 ward_id_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label pt-3 pb-0" for="from_date"> Select From Date <span class="text-danger">*</span></label>
                                    <input type="date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" id="from_date" name="from_date" class="form-control" >
                                    <span class="pristine-error text-theme-6 mt-1 from_date_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label pt-3 pb-0" for="days"> Select Days <span class="text-danger">*</span></label>
                                    <select name="days" id="days" class="form-control">
                                        <option value="">Select Days</option>
                                        <option value="1">1</option>
                                        <option value="3">3</option>
                                        <option value="5">5</option>
                                        <option value="7">7</option>
                                    </select>
                                    <span class="pristine-error text-theme-6 mt-1 days_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label pt-3 pb-0" for="to_date"> To Date <span class="text-danger">*</span></label>
                                    <input class="form-control" name="to_date" type="text" readonly>
                                    <span class="pristine-error text-theme-6 mt-1 to_date_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label pt-3 pb-0" for="length"> Banner Length <small>(in foot)</small> <span class="text-danger">*</span></label>
                                    <input class="form-control" name="length" type="number">
                                    <span class="pristine-error text-theme-6 mt-1 length_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label pt-3 pb-0" for="width"> Banner Width <small>(in foot)</small> <span class="text-danger">*</span></label>
                                    <input class="form-control" name="width" type="number">
                                    <span class="pristine-error text-theme-6 mt-1 width_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label pt-3 pb-0" for="price"> Fees Amount</label>
                                    <input class="form-control" name="price" type="number" readonly>
                                </div>

                                {{-- <div class="col-md-4">
                                    <label class="col-form-label pt-3 pb-0" for="banner_id">Banner Size & Fee<span class="text-danger">*</span></label>
                                    <select class="form-control js-example-basic-single" id="banner_id" name="banner_id">
                                        <option value="">Banner Size & Fee</option>
                                        @foreach ($banners as $banner)
                                            <option value="{{ $banner->id }}">{{ $banner->banner_size ." ||  ".$banner->amount }}</option>
                                        @endforeach
                                    </select>
                                    <span class="pristine-error text-theme-6 mt-1 banner_id_err"></span>
                                </div> --}}

                                <div class="col-md-4">
                                    <label class="col-form-label pt-3 pb-0" for="banner_image"> Upload Banner Image <span class="text-danger">*</span></label>
                                    <input class="form-control" name="banner_image" type="file">
                                    <span class="pristine-error text-theme-6 mt-1 banner_image_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label pt-3 pb-0" for="advertise_detail"> Details in Advertise <span class="text-danger">*</span></label>
                                    <textarea name="advertise_detail" class="form-control" style="max-height: 100px; min-height: 100px"></textarea>
                                    <span class="pristine-error text-theme-6 mt-1 advertise_detail_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label pt-3 pb-0" for="location">Enter Location<span class="text-danger">*</span></label>
                                    <textarea name="location" id="location" cols="10" rows="4" style="max-height: 100px; min-height: 100px" class="form-control"></textarea>
                                    {{-- <select class="form-control js-example-basic-single" id="location_id" name="location_id">
                                        <option value="">Select Location</option>
                                    </select> --}}
                                    <span class="pristine-error text-theme-6 mt-1 location_err"></span>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <h2 class="fs-lg fw-medium me-auto" style="margin: 15px 0">Upload Documents</h2>
                                @foreach ($documents as $document)
                                    <div class="col-md-4">
                                        <label class="col-form-label" for="docs"> Upload {{ $document->name }} <span class="text-danger">{{ ($document->is_required == 1) ? '*' : '' }}</span></label>
                                        <input class="form-control" name="docs_{{ $document->id }}" type="file" id="docs_{{$document->id}}" >
                                        <span class="pristine-error text-theme-6 mt-1 docs_{{$document->id}}_err"></span>
                                    </div>
                                @endforeach
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
    </div>

    @push('scripts')
        {{-- Add --}}
        <script>
            $("#addForm").submit(function(e) {
                e.preventDefault();
                $("#addSubmit").prop('disabled', true);

                var formdata = new FormData(this);
                $.ajax({
                    url: '{{ route('frontend.submit-application') }}',
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
                                    window.location.href = "{{ route('payment-list',0) }}";
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


        <script>
            // To Date calculation
            $(document).ready(function(){
                $('#days').change(function(){
                    var fromDate = $('#from_date').val();
                    if(!fromDate)
                    {
                        swal("Error!", "Please select from date", "error");
                    }
                    else
                    {
                        var days = parseInt($(this).val());
                        if(fromDate && days)
                        {
                            var toDate = new Date(fromDate);
                            toDate.setDate(toDate.getDate() + (days-1));
                            var formattedToDate = toDate.toISOString().split('T')[0];
                            $('input[name="to_date"]').val(formattedToDate);
                        }
                    }
                });

                $('#from_date').change(function(){
                    var days = parseInt($(this).val());
                    if(days)
                    {
                        var fromDate = $('#from_date').val();
                        if(fromDate && days)
                        {
                            var toDate = new Date(fromDate);
                            toDate.setDate(toDate.getDate() + (days-1));
                            var formattedToDate = toDate.toISOString().split('T')[0];
                            $('input[name="to_date"]').val(formattedToDate);
                        }
                    }
                    else
                    {
                    }
                });
            });


            // Cost calculation
            $(document).ready(function(){

                $('input[name="length"]').keyup( function(){
                    var length = parseInt($(this).val());
                    var width = parseInt($('input[name="width"]').val());
                    var days = parseInt($('select[name="days"]').val());

                    if(length && width && days)
                    {
                        if(length > 40)
                        {
                            swal("Error!", "Banner length must not be greater than 40 foot", "error");
                        }
                        else if(width > 30)
                        {
                            swal("Error!", "Banner width must not be greater than 30 foot", "error");
                        }
                        else
                        {
                            let singleDayAmount = 25/30;
                            let finalAmount = (((length*width) * singleDayAmount) * days);
                            finalAmount = Number.parseFloat(finalAmount).toFixed(2);
                            $('input[name="price"]').val(finalAmount);
                        }
                    }
                });

                $('input[name="width"]').keyup( function(){
                    var length = parseInt($(this).val());
                    var width = parseInt($('input[name="width"]').val());
                    var days = parseInt($('select[name="days"]').val());

                    if(length && width && days)
                    {
                        if(length > 40)
                        {
                            swal("Error!", "Banner length must not be greater than 40 foot", "error");
                        }
                        else if(width > 30)
                        {
                            swal("Error!", "Banner width must not be greater than 30 foot", "error");
                        }
                        else
                        {
                            let singleDayAmount = 25/30;
                            let finalAmount = (((length*width) * singleDayAmount) * days);
                            finalAmount = Number.parseFloat(finalAmount).toFixed(2);
                            $('input[name="price"]').val(finalAmount);
                        }
                    }
                });

            });
        </script>


        <!-- Get From Date Wise To Date -->
        {{-- <script>
            $("input[name='from_date']").change( function(e) {
                e.preventDefault();

                var from_date = $(this).val();
                if(from_date != '')
                {
                    var url = "{{ route('application.to-date', ':from_date') }}";
                    $.ajax({
                        url: url.replace(':from_date', from_date),
                        type: 'GET',
                        data: {
                            '_token': "{{ csrf_token() }}"
                        },
                        success: function(data, textStatus, jqXHR)
                        {
                            if (!data.error)
                            {
                                $("input[name='to_date']").val(data.to_date);
                            }
                            else
                            {
                                swal("Error!", data.error, "error");
                            }
                        },
                        error: function(error, jqXHR, textStatus, errorThrown) {
                            swal("Error!", "Some thing went wrong", "error");
                        },
                    });
                }
            });
        </script> --}}

    @endpush

</x-admin.layout>

