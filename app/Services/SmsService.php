<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SmsService
{
    public function sendApplicationSubmissionMessage($mobile)
    {
        $sms_enabled = config('services.sms.enabled');
        $test_numbers = config('services.sms.test_numbers');

        if ($sms_enabled && !in_array($mobile, $test_numbers))
        {
            $receiverNumber = "91" . $mobile;

            $username = config('services.sms.username');
            $password = config('services.sms.password');
            // $url = 'http://cloud.smsindiahub.in/vendorsms/pushsms.aspx?user='.$username.'&password='.$password.'&msisdn='.$receiverNumber.'&sid=ABACMA&msg=Your%20OTP%20is%20'.$otp.'%20ABCM%20App%20powered%20by%20AB%20Accessories&fl=0&gwid=2';
            // $response = Http::timeout(10)->get($url);

            // if( !$response )
            // {
            //     Log::info("Connection timeout or Otp error on login/registration.");
            //     return false;
            // }

            return true;
        }

        return true;
    }


    public function sendsms($sms,$number)
    {

    $key = "kbf8IN83hIxNTVgs";
    $mbl=$number; 	/*or $mbl="XXXXXXXXXX,XXXXXXXXXX";*/
    // $message=123;
    $message_content=urlencode($sms);

    $senderid="CoreOC";	$route= 1;
    $url = "http://sms.adityahost.com/vb/apikey.php?apikey=$key&senderid=$senderid&number=$mbl&message=$message_content";

    $output = file_get_contents($url);	/*default function for push any url*/

    }

}
