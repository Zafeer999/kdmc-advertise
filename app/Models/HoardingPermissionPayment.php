<?php

namespace App\Models;

use App\Factories\SmsProviderFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HoardingPermissionPayment extends BaseModel
{
    use HasFactory, SoftDeletes;

    const PAYMENT_STATUS_PENDING = '0';
    const PAYMENT_STATUS_SUCCESSFUL = '1';
    const PAYMENT_STATUS_FAILED = '2';
    const PAYMENT_STATUS_CANCELLED = '3';
    const PAYMENT_STATUS_REFUNDED = '4';

    protected $fillable = [ 'hoarding_permission_id', 'payment_id', 'transaction_id', 'payment_response', 'user_id', 'amount_payable', 'amount_paid', 'status', 'date' ];

    public function application()
    {
        return $this->belongsTo(HoardingPermission::class, 'hoarding_permission_id', 'id');
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class, 'hoarding_permission_payment_id', 'id')->latestOfMany();
    }

    public static function booted()
    {

        static::updated(function (self $applicationPayment)
        {
            if( self::PAYMENT_STATUS_SUCCESSFUL == $applicationPayment->status)
            {
                $applicationPayment->load('application.user');
                $smsProvider = SmsProviderFactory::get('aditya');

                $smsProvider->applicationPaymentSuccessSms($applicationPayment->application?->user?->mobile, $applicationPayment->application);
            }
            elseif( self::PAYMENT_STATUS_FAILED == $applicationPayment->status)
            {
                $applicationPayment->load('application.user');
                $smsProvider = SmsProviderFactory::get('aditya');

                $smsProvider->applicationPaymentFailedSms($applicationPayment->application?->user?->mobile, $applicationPayment->application);
            }
            elseif( self::PAYMENT_STATUS_CANCELLED == $applicationPayment->status)
            {
                $applicationPayment->load('application.user');
                $smsProvider = SmsProviderFactory::get('aditya');

                $smsProvider->applicationPaymentRefundSms($applicationPayment->application?->user?->mobile, $applicationPayment->application);
            }
        });

    }
}
