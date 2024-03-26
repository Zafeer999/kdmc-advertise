<?php

namespace App\Services\PaymentProvider;

use App\Models\HoardingPermission;
use App\Models\HoardingPermissionPayment;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Easebuzz\PayWithEasebuzzLaravel\PayWithEasebuzzLib;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Easebuzz extends Base
{
    protected PayWithEasebuzzLib $api;

    public function __construct()
    {
        $this->api = new PayWithEasebuzzLib(
                        config('services.easebuzz.easebuzz_key'),
                        config('services.easebuzz.easebuzz_salt'),
                        config('services.easebuzz.easebuzz_env')
                    );
    }

    public function getProviderName()
    {
        return 'easebuzz';
    }

    public function initiatePayment(User $user, HoardingPermission $application)
    {
        $payment = $application->payment()->first();
        $transaction = Transaction::create([
                    'user_id' => $user->id,
                    'transaction_no' => Transaction::generateTransactionId(),
                    'hoarding_permission_payment_id' => $payment->id
                ]);

        $data['key'] = config('services.easebuzz.easebuzz_key');
        $data['txnid'] = $transaction->transaction_no;
        $application->load('payment');
        $data['amount'] = $application->payment->amount_payable;
        $data['productinfo'] = Str::limit($application->advertise_detail, 80);
        $data['firstname'] = $application->full_name;
        $data['phone'] = $user->mobile;
        $data['email'] = $user->email;
        $data['surl'] = route('payment-success');
        $data['furl'] = route('payment-failed');
        $data['hash'] = "";
        $data['udf1'] = $application->id;
        $data['udf2'] = $payment->id;
        $data['udf3'] = $transaction->id;

        $result = $this->api->initiatePaymentAPI($data, true);
        Log::error($result);

        return "Payment failed to initialize";
    }

    public function handleResponse(Request $request)
    {

    }

    public function paymentSuccess(Request $request)
    {
        $application = HoardingPermission::find($request->udf1);
        $payment = HoardingPermissionPayment::find($request->udf2);
        $transaction = Transaction::find($request->udf3);

        try
        {
            DB::beginTransaction();
            $payment->payment_id = $request->easepayid;
            $payment->payment_response = json_encode($request->all());
            $payment->amount_paid = $request->net_amount_debit;
            $payment->status = HoardingPermissionPayment::PAYMENT_STATUS_SUCCESSFUL;
            $payment->save();

            $application->payment_status = HoardingPermission::PAYMENT_STATUS_SUCCESSFUL;
            $application->save();

            if($transaction)
            {
                $transaction->info = json_encode($request->all());
                $transaction->status = Transaction::PAYMENT_STATUS_SUCCESSFUL;
                $transaction->save();
            }
            DB::commit();
        }
        catch(Exception $e)
        {
            Log::error("Payment success handling error". $e);
        }

        return view('frontend.payment-success')->with(['application' => $application, 'payment' => $payment, 'transaction' => $transaction]);
    }

    public function paymentFailed(Request $request)
    {
        $transaction = Transaction::find($request->udf3);
        $payment = $transaction->payment()->first();

        try
        {
            DB::beginTransaction();
            if($transaction)
            {
                $transaction->info = json_encode($request->all());
                $transaction->status = Transaction::PAYMENT_STATUS_FAILED;
                $transaction->save();
            }
            DB::commit();
        }
        catch(Exception $e)
        {
            Log::error("Payment failed handling error". $e);
        }

        return view('frontend.payment-failed')->with(['payment' => $payment, 'transaction' => $transaction]);
    }

    public function initiateRefund($application)
    {
        $payment = $application->payment()->first();
        $transaction = $payment->transaction()->first();
        $user = Auth::user();

        $refundId = $transaction->generateRefundId();
        $transaction->save();

        $transactionData = json_decode($payment->payment_response, true);

        $result = $this->api->refundAPIV2([
            "txnid" => $transaction->transaction_no,
            "merchant_refund_id" => $refundId,
            "easebuzz_id" => $payment->payment_id,
            "refund_amount" => number_format($payment->amount_paid, 2, '.', ''),
            "phone" => $user->mobile,
            "email" => $user->email,
            "amount" => $payment->amount_paid,
            "hash" => $transactionData['hash'],
        ]);

        if( json_decode($result, true)['status'] )
            $transaction->update(['refund_response' => $result]);

        return $result;
    }
}
