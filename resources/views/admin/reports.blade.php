<x-admin.layout>
    <x-slot name="title" >Report</x-slot>
    <x-slot name="breadcrumb">Report</x-slot>



    <!-- Add Form -->
    <div class="row" id="addContainer">
        <div class="col-sm-12">
            <div class="card">
                <h2 class="fs-lg fw-medium me-auto" style="margin: 15px">Filter Report</h2>
                <form class="theme-form" method="get" action="{{ route('reports.index') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">
                        <div class="mb-3 row">

                            <div class="col-md-4">
                                <label class="col-form-label pt-3 pb-0" for="adv_type"> Advertise Type <span class="text-danger">*</span></label>
                                <select name="adv_type" id="adv_type" class="form-control">
                                    <option value="">Select Advertise Type</option>
                                    <option {{ request()->adv_type == 'Cloth' ? 'selected' : '' }} value="Cloth">Cloth</option>
                                    <option {{ request()->adv_type == 'Banners' ? 'selected' : '' }} value="Banners">Banner</option>
                                    <option {{ request()->adv_type == 'Hoardings' ? 'selected' : '' }} value="Hoardings">Hoardings</option>
                                    <option {{ request()->adv_type == 'Poster' ? 'selected' : '' }} value="Poster">Poster</option>
                                    <option {{ request()->adv_type == 'Kamani' ? 'selected' : '' }} value="Kamani">Kamani</option>
                                </select>
                                <span class="pristine-error text-theme-6 mt-1 adv_type_err"></span>
                            </div>

                            <div class="col-md-4 ward_div">
                                <label class="col-form-label" for="name">Select Ward<span class="text-danger">*</span></label>
                                <select class="tom-select" id="ward" name="ward">
                                    <option value="">Select Ward</option>
                                    @foreach ($wards as $ward)
                                        <option {{ request()->ward == $ward->id ? 'selected' : '' }} value="{{ $ward->id }}">{{ $ward->name }}</option>
                                    @endforeach
                                </select>
                                <span class="pristine-error text-theme-6 mt-1 ward_err"></span>
                            </div>

                            <div class="col-md-4">
                                <label class="col-form-label" for="from_date">From Date <span class="text-danger">*</span></label>
                                <input class="form-control" name="from_date" id="from_date" type="date" onclick="this.showPicker()" placeholder="Enter From Date">
                                <span class="pristine-error text-theme-6 mt-1 from_date_err"></span>
                            </div>

                            <div class="col-md-4">
                                <label class="col-form-label" for="to_date">To Date <span class="text-danger">*</span></label>
                                <input class="form-control" name="to_date" id="to_date" type="date" onclick="this.showPicker()" placeholder="Enter To Date">
                                <span class="pristine-error text-theme-6 mt-1 to_date_err"></span>
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


    <div class="intro-y box p-5 mt-5">

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
                            <th style="min-width:90px;">Banner Size</th>
                            <th style="min-width:90px;">Amount</th>
                            <th style="min-width:70px;">Advertise Details</th>
                            <th>Banner Image</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->application_no }}</td>
                                <td>{{ $data->full_name }}</td>
                                <td>{{ $data->contact_no }}</td>
                                <td>{{ $data->ward?->name }}</td>
                                <td>{{ $data->location }}</td>
                                <td>{{ $data->from_date }}</td>
                                <td>{{ $data->to_date }}</td>
                                <td>{{ $data->banner?->banner_size .' / '. $data?->banner?->amount }}</td>
                                <td></td>
                                <td>{{ $data->advertise_detail }}</td>
                                <td>
                                    <a href="{{ asset($data->banner_image) }}" target="blank" class="btn btn-primary">View_Banner_Image</a>
                                </td>
                                <td> <span style="background-color: #17a2b8; color: #fff; border-radius: 3px; padding: 2px 4px; text-wrap: nowrap">{{ $data->status_name }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


    </div>
    @push('scripts')


    @endpush

</x-admin.layout>

