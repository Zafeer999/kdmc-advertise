<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HoardingPermission;
use App\Models\HoardingPermissionPayment;
use App\Models\User;
use App\Models\Ward;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $authUser = Auth::user();


        $wards = Ward::
                    when( $authUser->hasRole(['Police', 'Ward']), fn ($q) => $q->where('id', $authUser->ward_id) )
                    ->latest()->get();

        $totalPermissions = HoardingPermission::query()
                        ->when( $authUser->hasRole(['Police', 'Ward']), fn ($q) => $q->where('ward_id', $authUser->ward_id) )
                        ->when( $authUser->hasRole(['User']), fn ($q) => $q->where('user_id', $authUser->id) )
                        ->count();

        $paymentSuccess = HoardingPermission::query()
        ->when( $authUser->hasRole(['Police', 'Ward']), fn ($q) => $q->where('ward_id', $authUser->ward_id) )
        ->when( $authUser->hasRole(['User']), fn ($q) => $q->where('user_id', $authUser->id) )
        ->where('payment_status',HoardingPermissionPayment::PAYMENT_STATUS_SUCCESSFUL)
        ->count();



        $cancelled = HoardingPermission::query()
        ->when( $authUser->hasRole(['Police', 'Ward']), fn ($q) => $q->where('ward_id', $authUser->ward_id) )
        ->when( $authUser->hasRole(['User']), fn ($q) => $q->where('user_id', $authUser->id) )
        ->where('payment_status',HoardingPermissionPayment::PAYMENT_STATUS_CANCELLED)
        ->count();



        $table_arr = [];
        foreach($wards as $ward)
        {
            $total = HoardingPermission::query()
            ->when( !$authUser->hasRole(['User']), fn ($q) => $q->where('ward_id', $ward->id) )
            ->count();

            $paymentSuccessWard = HoardingPermission::query()
            ->when( !$authUser->hasRole(['User']), fn ($q) => $q->where('ward_id', $ward->id) )
            ->where('payment_status',HoardingPermissionPayment::PAYMENT_STATUS_SUCCESSFUL)
            ->count();

            $cancelWard = HoardingPermission::query()
            ->when( !$authUser->hasRole(['User']), fn ($q) => $q->where('ward_id', $ward->id) )
            ->where('payment_status',HoardingPermissionPayment::PAYMENT_STATUS_CANCELLED)
            ->count();

            $pendingWard = HoardingPermission::query()
            ->when( !$authUser->hasRole(['User']), fn ($q) => $q->where('ward_id', $ward->id) )
            ->where('payment_status',HoardingPermissionPayment::PAYMENT_STATUS_PENDING)
            ->count();


            $table_arr[] = array(
                        'ward_name'          => $ward->name,
                        'ward_id'            => $ward->id,
                        'total'              => $total,
                        'paymentSuccessWard' => $paymentSuccessWard,
                        'cancelWard'         => $cancelWard,
                        'pendingWard'        => $pendingWard
            );
        }

        return view('admin.home')->with([
                            'authUser'          => $authUser,
                            'table_arr'         => $table_arr,
                            'totalPermissions'  => $totalPermissions,
                            'paymentSuccess'    => $paymentSuccess,
                            'cancelled'         => $cancelled

                        ]);
    }
}
