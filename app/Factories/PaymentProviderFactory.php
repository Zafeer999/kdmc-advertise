<?php

namespace App\Factories;

use Illuminate\Support\Str;
use App\Services\PaymentProvider\Base;
use App\Services\PaymentProvider\Easebuzz;
use Exception;

class PaymentProviderFactory
{
    public static function get($provider)
    {
        $provider = Str::lower($provider);

        switch($provider)
        {
            case 'razorpay':
                return '';
                break;

            case 'easebuzz':
                return new Easebuzz();
                break;
        }
        throw new Exception("Unsopperted Payment Method");
    }
}
