@php $isUser = Auth::user()->hasRole(['User']);
     $wardUser = Auth::user()->hasRole(['Police', 'Ward']);
@endphp

<x-admin.layout>
    <x-slot name="title">Dashboard</x-slot>

     @push('styles')
    <style>
        .table-cell-style {
            font-size: 18px;
            font-weight: bold;
        }
    </style>
    @endpush

    <div class="grid columns-12 gap-6">
        <div class="g-col-12 g-col-xxl-12">
            <div class="grid columns-12 gap-6">
                <div class="g-col-12 mt-8 mb-5">
                    <div class="intro-y d-flex align-items-center h-10">
                        <h2 class="fs-lg fw-medium truncate me-5">
                            General Report
                        </h2>
                        <a href="{{ route('dashboard') }}" class="ms-auto d-flex align-items-center text-theme-1 dark-text-theme-10"> <i data-feather="refresh-ccw" class="w-4 h-4 me-3"></i> Reload Data </a>
                    </div>
                    <div class="grid columns-12 gap-6 mt-5">

                        <div class="g-col-12 g-col-sm-6 g-col-xl-3 intro-y mb-5">
                            @if (!$isUser)
                            <a href="{{ route('permission-requests',0); }}">
                            @else
                            <a href="{{ route('payment-list',3); }}">
                            @endif
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="d-flex">
                                        <div class="ms-auto">
                                            <div class="report-box__indicator bg-theme-10 px-3 py-2">
                                                <i class="fas fa-rectangle-list"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="report-box__total fs-3xl fw-medium mt-6">{{ $totalPermissions }}</div>
                                    <div class="fs-base text-gray-600 mt-1">Total Permissions </div>
                                </div>
                            </div>
                            </a>
                        </div>
                        <div class="g-col-12 g-col-sm-6 g-col-xl-3 intro-y">
                            @if (!$isUser)
                            <a href="{{ route('permission-requests',1); }}">
                            @else
                            <a href="{{ route('payment-list',1); }}">
                            @endif
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="d-flex">
                                        <div class="ms-auto">
                                            <div class="report-box__indicator bg-theme-12 px-3 py-2">
                                                <i class="fas fa-rectangle-list"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="report-box__total fs-3xl fw-medium mt-6">{{ $paymentSuccess }} </div>
                                    <div class="fs-base text-gray-600 mt-1">Payment Success </div>
                                </div>
                            </div>
                            </a>
                        </div>
                        <div class="g-col-12 g-col-sm-6 g-col-xl-3 intro-y">
                            @if (!$isUser)
                            <a href="{{ route('permission-requests',2); }}">
                            @else
                                <a href="{{ route('payment-list', 2) }}">
                            @endif
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="d-flex">
                                        <div class="ms-auto">
                                            <div class="report-box__indicator bg-theme-12 px-3 py-2">
                                                <i class="fas fa-rectangle-list"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="report-box__total fs-3xl fw-medium mt-6">{{ $cancelled }} </div>
                                    <div class="fs-base text-gray-600 mt-1">Cancelled Applications </div>
                                </div>
                            </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            @if (!$isUser)
                <div class="overflow-x-auto scrollbar-hidden mt-5">
                    <div class="table-responsive">
                        <table class="table-bordered" id="datatable-tabletools">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Ward</th>
                                    <th>Total Applications</th>
                                    <th>Pending</th>
                                    <th>Payment Success</th>
                                    <th>Cancelled</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($table_arr as $key => $row)
                                <tr>
                                    <td class="table-cell-style">{{ $loop->iteration }}</td>
                                    <td class="table-cell-style">{{ $row['ward_name'] }}</td>
                                    <td class="table-cell-style">
                                        <a href="{{ $wardUser ? route('permission-requests', 0) : route('permission-requests-ward', ['id' => 0, 'ward_id' => $row['ward_id']]) }}" class="table-cell-style">
                                            {{ $row['total'] }}
                                        </a>
                                    </td>
                                    <td class="table-cell-style">{{ $row['pendingWard'] }}</td>
                                    <td class="table-cell-style">
                                        <a href="{{ $wardUser ? route('permission-requests', 1) : route('permission-requests-ward', ['id' => 1, 'ward_id' => $row['ward_id']]) }}" class="table-cell-style">
                                            {{ $row['paymentSuccessWard'] }}
                                        </a>
                                    </td>
                                    <td class="table-cell-style">
                                        <a href="{{ $wardUser ? route('permission-requests', 2) : route('permission-requests-ward', ['id' => 2, 'ward_id' => $row['ward_id']]) }}" class="table-cell-style">
                                            {{ $row['cancelWard'] }}
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>

</x-admin.layout>
