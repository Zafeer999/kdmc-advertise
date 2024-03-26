<?php

namespace App\Services\SmsProvider;

use App\Services\SmsProvider\Base;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Aditya extends Base
{
    public $isSmsEnabled;
    public $testNumbers;
    public $key;
    public $senderId;
    public $route;
    public $baseUrl;

    public function __construct()
    {
        $this->isSmsEnabled = config('services.sms.enabled');
        $this->testNumbers = config('services.sms.test_numbers');
        $this->key = config('services.sms.aditya_sms.key');
        $this->senderId = config('services.sms.aditya_sms.senderid');
        $this->route = config('services.sms.aditya_sms.route');
        $this->baseUrl = 'http://sms.adityahost.com/vb/apikey.php';
    }

    public function getProviderName()
    {
        return 'aditya';
    }

    public function applicationSubmissionSms($number, $application)
    {
        $content = 'Your application submitted successfully on temporary advertise permission dated from ('.$application->from_date.' to '.$application->to_date.') and your application no is '.$application->application_no.'. Login to the portal to track your application - CoreOC. ';

        return $this->sendSms($number, $content);
    }

    public function applicationExpirySms($number, $application)
    {
        $content = 'Your application '.$application->application_no.' for temporary advertise permission is expiring today. Kindly remove your advertisement before the due date to avoid deduction from your deposit. - CoreOC';

        return $this->sendSms($number, $content);
    }

    public function applicationPaymentRefundSms($number, $application)
    {
        $content = 'Your recent application for temporary advertise permission dated from ('.$application->from_date.' to '.$application->to_date.') has been canceled successfully. We have initiated the refund process - CoreOC.';

        return $this->sendSms($number, $content);
    }

    public function applicationPaymentFailedSms($number, $application)
    {
        $content = 'Your recent payment attempt for temporary advertise permission dated from ('.$application->from_date.' to '.$application->to_date.') has failed, please retry your payment - CoreOC.';

        return $this->sendSms($number, $content);
    }

    public function applicationPaymentSuccessSms($number, $application)
    {
        $application->load('payment');
        $content = 'Thank you for your payment of '.$application->payment?->amount_paid.'/- on '.$application->payment?->date.' for temporary advertise permission dated from ('.$application->from_date.' to '.$application->to_date.') . Your transaction was successful - CoreOC.';

        return $this->sendSms($number, $content);
    }

    private function sendSms($number, $content)
    {
        try
        {
            $response = Http::get($this->baseUrl,[
                'apikey' => $this->key,
                'senderid' => $this->senderId,
                'number' => $number,
                'message' => $content,
                ]);

            return $response;
        }
        catch(Exception $e)
        {
            Log::info($e);
            return true;
        }

    }
}
