<?php

namespace App\Models;

use App\Factories\SmsProviderFactory;
use App\Mail\ApplicationSubmissionMail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class HoardingPermission extends BaseModel
{
    use HasFactory, SoftDeletes;

    const APPLICATION_STATUS_PENDING = '0';
    const APPLICATION_WARD_APPROVE = '1';
    const APPLICATION_WARD_REJECT = '2';
    const APPLICATION_POLICE_APPROVE = '3';
    const APPLICATION_POLICE_REJECT = '4';

    const PAYMENT_STATUS_PENDING = '0';
    const PAYMENT_STATUS_SUCCESSFUL = '1';
    const PAYMENT_STATUS_FAILED = '2';
    const PAYMENT_STATUS_CANCELLED = '3';
    const PAYMENT_STATUS_REFUNDED = '4';

    protected $fillable = [
        'user_id',
        'full_name',
        'contact_no',
        'advertise_type',
        'ward_id',
        'location',
        'from_date',
        'to_date',
        'days',
        'length',
        'width',
        'price',
        // 'banner_id',
        'banner_image',
        'advertise_detail',
        'payment_status',
        'status',
        'application_no',
        'status_by',
        'status_date',
        'building_name',
        'area',
        'landmark',
        'city',
        'pincode',
        'alternate_contact_no',
        'aadhar_card_no',
        // 'pan_card_no',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $appends = ['status_name'];


    public function getStatusNameAttribute()
    {
        $statusName = collect(config('default_data.permission_status'));
        return $statusName->where('id', $this->status)->first()['name'];
    }

    public function generateApplicationNo()
    {
        $applicationNo = '';
        if($this->application_no == '')
        {
            do{
                $applicationNo = 'TAP'.date('m').date('d').sprintf("%05d", mt_rand(10000, 99999));
            }
            while($this->where('application_no', $applicationNo)->exists());
            $this->application_no = $applicationNo;
            $this->save();
        }
        else
        {
            $applicationNo = $this->application_no;
        }

        return $applicationNo;
    }

    public function generateQrCode()
    {
        $qrPath = '';
        if($this->qr_path == '')
        {
            if($this->application_no == '')
            {
                $this->generateApplicationNo();
            }
            $qrPath = 'storage/qr/'.$this->application_no.'.svg';
            QrCode::format('svg')->generate( route('frontend.show-certificate', $this->id), public_path($qrPath));

            $this->qr_path = $qrPath;
            $this->save();
        }
        else
        {
            $qrPath = $this->qr_path;
        }

        return $qrPath;
    }
    public static function amountPayable($application)
    {
        return $application->price;
    }

    public function payment()
    {
        return $this->hasOne(HoardingPermissionPayment::class);
    }

    public function ward()
    {
        return $this->hasOne(Ward::class, 'id', 'ward_id');
    }

    // public function Location()
    // {
    //     return $this->hasOne(Location::class, 'id', 'location_id');
    // }

    public function banner()
    {
        return $this->hasOne(Banner::class, 'id', 'banner_id');
    }

    public function documents()
    {
        return $this->hasMany(HoardingPermissionDoc::class, 'hoarding_permission_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function booted()
    {
        static::created(function (HoardingPermission $hoardingPermission)
        {
            if(Auth::check())
            {
                // $smsProvider = SmsProviderFactory::get('aditya');
                // $hoardingPermission->load('user');
                // $smsProvider->applicationSubmissionSms($hoardingPermission->user?->mobile, $hoardingPermission);

                // try{
                //     Mail::to($hoardingPermission->user?->email)->send(new ApplicationSubmissionMail($hoardingPermission->user, $hoardingPermission));
                // }
                // catch(\Exception $e)
                // {
                //     Log::info($e);
                // }
                self::where('id', $hoardingPermission->id)->update([
                    'created_by'=> Auth::user()->id,
                ]);
            }
        });
        static::updated(function (HoardingPermission $hoardingPermission)
        {
            if(Auth::check())
            {
                self::where('id', $hoardingPermission->id)->update([
                    'updated_by'=> Auth::user()->id,
                ]);
            }
        });
        static::deleting(function (HoardingPermission $hoardingPermission)
        {
            if(Auth::check())
            {
                self::where('id', $hoardingPermission->id)->update([
                    'deleted_by'=> Auth::user()->id,
                ]);
            }
        });
    }
}
