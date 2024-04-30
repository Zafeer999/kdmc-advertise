<x-admin.layout>
    <x-slot name="title" >Certificate Application List</x-slot>
    <x-slot name="breadcrumb">Certificate Application List</x-slot>

    <div class="intro-y box p-5 mt-5">
        <h2 class="fs-lg fw-medium me-auto" style="margin: 15px 0">
            Certificate Application List
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
                                <td>{{ $application->banner?->banner_size .' | '. $application->banner?->amount }}</td>
                                <td>{{ $application->advertise_detail }}</td>
                                <td>
                                    <a href="{{ asset($application->banner_image) }}" target="_blank" class="btn btn-info">View Banner</a>
                                </td>
                                <td>
                                    <a href="{{ route('download-certificate', $application->id) }}" target="_blank"><button class="edit-element btn px-2 py-1" title="Download Certificate"><i class="fas fa-stamp"></i> &nbsp;Certificate </button></a>
                                </td>
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

