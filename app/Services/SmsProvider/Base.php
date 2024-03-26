<?php

namespace App\Services\SmsProvider;

use Illuminate\Http\Request;

abstract class Base{

    abstract public function getProviderName();
    abstract public function applicationSubmissionSms($number, $application);
    abstract public function applicationExpirySms($number, $application);
    abstract public function applicationPaymentRefundSms($number, $application);
    abstract public function applicationPaymentFailedSms($number, $application);
    abstract public function applicationPaymentSuccessSms($number, $application);
}
