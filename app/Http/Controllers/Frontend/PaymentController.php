<?php

namespace App\Http\Controllers\Frontend;

use App\Factories\PaymentProviderFactory;
use App\Http\Controllers\Controller;
use App\Models\HoardingPermission;
use App\Models\HoardingPermissionPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{

    public function __construct(protected $provider = 'easebuzz')
    {
    }

    public function paymentList($status)
    {
        $authUser = Auth::user();

        $applications = HoardingPermission::query()
                            ->with('ward', 'banner', 'payment')
                            // ->where('status', HoardingPermission::APPLICATION_POLICE_APPROVE)
                            ->when( $authUser->hasRole(['User']), fn ($q) => $q->where('user_id', $authUser->id) )
                            ->when( $authUser->hasRole(['Police', 'Ward']), fn ($q) => $q->where('ward_id', $authUser->ward_id) )
                            ->when( $status == 1, fn ($query) => $query->where('payment_status', HoardingPermissionPayment::PAYMENT_STATUS_SUCCESSFUL))
                            ->when( $status == 0, fn ($query) => $query->where('payment_status', HoardingPermissionPayment::PAYMENT_STATUS_PENDING) )
                            ->when( $status == 2, fn ($query) => $query->where('payment_status', HoardingPermissionPayment::PAYMENT_STATUS_CANCELLED) )
                            ->latest()
                            ->get();

        return view('admin.pending-payment-list')->with(['applications' => $applications,'status'=>$status]);
    }

    public function initiatePayment(Request $request, HoardingPermission $application)
    {
        $paymentProvider = PaymentProviderFactory::get($this->provider);

        $response = $paymentProvider->initiatePayment(Auth::user(), $application);
        return $response;
    }

    public function paymentSuccess(Request $request)
    {
        $paymentProvider = PaymentProviderFactory::get($this->provider);

        return $paymentProvider->paymentSuccess($request);
    }

    public function paymentFailed(Request $request)
    {
        $paymentProvider = PaymentProviderFactory::get($this->provider);
        return $paymentProvider->paymentFailed($request);
    }

    public function paymentSuccessPage(Request $request)
    {
        return view('frontend.payment-success');
    }
    public function paymentFailedPage(Request $request)
    {
        return view('frontend.payment-failed');
    }
}
