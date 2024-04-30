<x-admin.layout>
    <x-slot name="title" >
        {{-- {{  ($status == 1)?  'Payment Success Applications' : 'Total Applications' }} --}}

        @if($status == 1)
            {{ 'Payment Success Applications' }}
        @elseif ($status == 2)
            {{ 'Cancelled Applications' }}
        @else
            {{ 'Total Applications' }}
        @endif


        </x-slot>
    <x-slot name="breadcrumb">
        @if($status == 1)
        {{ 'Payment Success Applications' }}
        @elseif ($status == 2)
            {{ 'Cancelled Applications' }}
        @else
            {{ 'Total Applications' }}
        @endif
    </x-slot>

    <div class="intro-y box p-5 mt-5">
        <h2 class="fs-lg fw-medium me-auto" style="margin: 15px 0">
            @if($status == 1)
            {{ 'Payment Success Applications' }}
            @elseif ($status == 2)
                {{ 'Cancelled Applications' }}
            @else
                {{ 'Total Applications' }}
            @endif
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
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($HoardingPermissions as $HoardingPermission)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $HoardingPermission->application_no }}</td>
                                <td>{{ $HoardingPermission->full_name }}</td>
                                <td>{{ $HoardingPermission->contact_no }}</td>
                                <td>{{ $HoardingPermission->ward?->name }}</td>
                                <td>{{ $HoardingPermission->location }}</td>
                                <td>{{ $HoardingPermission->from_date }}</td>
                                <td>{{ $HoardingPermission->to_date }}</td>
                                <td>{{ $HoardingPermission->banner?->banner_size .' / '. $HoardingPermission?->banner?->amount }}</td>
                                <td>{{ $HoardingPermission->advertise_detail }}</td>
                                <td>
                                    <a href="{{ asset($HoardingPermission?->banner_image) }}" target="blank" class="btn btn-primary">View_Banner_Image</a>
                                </td>
                                <td> <span style="background-color: #17a2b8; color: #fff; border-radius: 3px; padding: 2px 4px; text-wrap: nowrap">{{ $HoardingPermission->status_name }}</span></td>
                                <td>
                                    {{-- <a href="{{ route('view-application',$HoardingPermission->id) }}"><button class="edit-element btn px-2 py-1" title="Edit location"><i class="far fa-pen-to-square"></i> &nbsp;View</button></a> --}}
                                    <a href="{{ route('view-application', $HoardingPermission->id) }}">
                                        <button class="edit-element btn btn-warning me-1 mb-2" title="View Application"><i class="far fa-pen-to-square"></i> &nbsp;View</button>
                                    </a>
                                    @if ($HoardingPermission->payment_status == 0 && $HoardingPermission->status >= 4)
                                        @if ($authUser->hasRole(['Admin', 'User']))
                                            <a target="_blank" href="{{ route('initiate-payment', $HoardingPermission->id) }}">
                                                <button class="btn btn-primary" title="Make Payment"><i class="fas fa-credit-card"></i> &nbsp;Pay</button>
                                            </a>
                                        @endif
                                    @elseif($HoardingPermission->payment_status == 1)
                                        <a href="#">
                                            <button class="btn btn-light" title="Payment Successful"><i class="fas fa-credit-card"></i> &nbsp;Paid </button>
                                        </a>
                                    @elseif($HoardingPermission->payment_status == 2)
                                        <a href="#">
                                            <button class="btn btn-warning" title="Payment Failed"><i class="fas fa-triangle-exclamation"></i> &nbsp;Failed </button>
                                        </a>
                                    @elseif($HoardingPermission->payment_status == 3)
                                        <a href="#">
                                            <button class="btn btn-danger" title="Payment Cancelled"><i class="fas fa-ban"></i> &nbsp;Cancelled </button>
                                        </a>
                                    @elseif($HoardingPermission->payment_status == 4)
                                        <a href="#">
                                            <button class="btn btn-dark text-white" title="Refunded"><i class="fas fa-file-invoice-dollar"></i> &nbsp;Refunded </button>
                                        </a>
                                    @else

                                    @endif

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

