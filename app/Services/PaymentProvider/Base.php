<?php

namespace App\Services\PaymentProvider;

use App\Models\HoardingPermission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


abstract class Base{

    abstract public function getProviderName();
    abstract public function initiatePayment(User $user, HoardingPermission $application);
    abstract public function handleResponse(Request $request);
    abstract public function paymentSuccess(Request $request);
    abstract public function paymentFailed(Request $request);

}
