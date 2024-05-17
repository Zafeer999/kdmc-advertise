<x-admin.layout>
    <x-slot name="title" >
        @if($status == 0){{ 'Pending Payment Application List' }} @elseif($status == 1){{ 'Payment Success Applications' }}@else{{ 'Total Applications' }}@endif
    </x-slot>
    <div class="intro-y box p-5 mt-5">
        <h2 class="fs-lg fw-medium me-auto" style="margin: 15px 0">
            @if($status == 0){{ 'Pending Payment Application List' }} @elseif($status == 1){{ 'Payment Success Applications' }}@else{{ 'Total Applications' }}@endif
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
                            <th>From Date</th>
                            <th>To Date</th>
                            <th>Days</th>
                            <th>Banner Size</th>
                            <th>Amount</th>
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
                                <td>{{ $application->days }} Days</td>
                                <td>{{ $application->length }} x {{ $application->width }}</td>
                                <td>{{ $application->payment?->amount_payable }}/-</td>
                                <td>
                                    <a href="{{ route('view-application',$application->id) }}">
                                        <button class="edit-element btn btn-warning me-1 mb-2" title="View Application"><i class="far fa-pen-to-square"></i> &nbsp;View</button>
                                    </a>
                                    @if( in_array($application->status, [2,4]) )
                                        <a href="">
                                            <button class="btn btn-danger" title="application rejected"><i class="fas fa-user-xmark"></i> &nbsp;Application rejected </button>
                                        </a>
                                    @elseif( in_array($application->status, [1,0]) )
                                        <a href="">
                                            <button class="btn btn-info" title="Pending for approval"><i class="fas fa-user-check"></i> &nbsp;Approval Pending </button>
                                        </a>
                                    @else
                                        @if ($application->payment_status == 0)
                                            <a target="_blank" href="{{ route('initiate-payment', $application->id) }}">
                                                <button class="btn btn-primary" title="Make Payment"><i class="fas fa-credit-card"></i> &nbsp;Pay </button>
                                            </a>
                                        @elseif($application->payment_status == 1)
                                            <a href="#">
                                                <button class="btn btn-light" title="Payment Successful"><i class="fas fa-credit-card"></i> &nbsp;Paid </button>
                                            </a>
                                        @elseif($application->payment_status == 2)
                                            <a href="#">
                                                <button class="btn btn-warning" title="Payment Failed"><i class="fas fa-triangle-exclamation"></i> &nbsp;Failed </button>
                                            </a>
                                        @elseif($application->payment_status == 3)
                                            <a href="#">
                                                <button class="btn btn-danger" title="Payment Cancelled"><i class="fas fa-ban"></i> &nbsp;Cancelled </button>
                                            </a>
                                        @elseif($application->payment_status == 4)
                                            <a href="#">
                                                <button class="btn btn-dark text-white" title="Refunded"><i class="fas fa-file-invoice-dollar"></i> &nbsp;Refunded </button>
                                            </a>
                                        @else
                                            <a target="_blank" href="{{ route('initiate-payment', $application->id) }}">
                                                <button class="btn btn-primary" title="Make Payment"><i class="fas fa-credit-card"></i> &nbsp;Pay </button>
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
    </div>
    @push('scripts')

    @endpush

</x-admin.layout>

