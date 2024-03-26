<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    const PAYMENT_STATUS_SUCCESSFUL = '1';
    const PAYMENT_STATUS_FAILED = '2';
    const PAYMENT_STATUS_CANCELLED = '3';
    const PAYMENT_STATUS_REFUNDED = '4';
    const PAYMENT_STATUS_PENDING = '0';

    protected $fillable = [ 'user_id', 'hoarding_permission_payment_id', 'transaction_no', 'refund_id', 'refund_response', 'info', 'status' ];

    public static function generateTransactionId()
    {
        $transactionNo = '';
        do{
            $transactionNo = 'TR'.substr(str_shuffle(MD5(microtime())), 0, 10);
        }
        while(self::where('transaction_no', $transactionNo)->exists());

        return $transactionNo;
    }

    public function generateRefundId()
    {
        $refundId = '';
        if($this->refund_id == '' || $this->refund_id == null)
        {
            do{
                $refundId = 'ref_'.substr(str_shuffle(MD5(microtime())), 0, 6).mt_rand(1000,9999);
            }
            while($this->where('refund_id', $refundId)->exists());
            $this->refund_id = $refundId;
            $this->save();
        }
        else
        {
            $refundId = $this->refund_id;
        }

        return $refundId;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payment()
    {
        return $this->belongsTo(HoardingPermissionPayment::class, 'hoarding_permission_payment_id', 'id');
    }
}
