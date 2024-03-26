<?php

namespace App\Factories;

use App\Services\SmsProvider\Aditya;
use Illuminate\Support\Str;
use Exception;

class SmsProviderFactory
{
    public static function get($provider)
    {
        $provider = Str::lower($provider);

        switch($provider)
        {
            case 'aditya':
                return new Aditya();
                break;

            case 'another':
                return '';
                break;
        }

        throw new Exception("Unsopperted SMS Gateway");
    }
}
