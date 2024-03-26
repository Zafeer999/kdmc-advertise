<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'sms' => [
        'username' => env('SMS_USERNAME', ''),
        'password' => env('SMS_PASSWORD', ''),
        'enabled' => env('SMS_ENABLED', false),
        'test_numbers' => ['9999999991', '9999999992', '9999999993', '9999999994', '9999999995', '9999999996', '9999999997', '9999999998', '7666451305'],

        'aditya_sms' => [
            'key' => env('ADITYA_SMS_KEY', 'kbf8IN83hIxNTVgs'),
            'senderid' => env('ADITYA_SMS_SENDERID', 'CoreOC'),
            'route' => env('ADITYA_SMS_ROUTE', '1'),
        ]
    ],


    'easebuzz' => [
        'easebuzz_key' => env('EASEBUZZ_KEY', "2PBP7IABZ2"),
        'easebuzz_salt' => env('EASEBUZZ_SALT', "DAH88E3UWQ"),
        'easebuzz_env' => env('EASEBUZZ_ENV', "test"),
        'easebuzz_url' => env('EASEBUZZ_URL', "testpay.easebuzz.in ")
    ],

];
