<?php

namespace App\Http\Controllers\Frontend;

use App\Factories\PaymentProviderFactory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\StoreApplicationRequest;
use App\Models\Banner;
use App\Models\Document;
use App\Models\HoardingPermission;
use App\Models\HoardingPermissionDoc;
use App\Models\HoardingPermissionPayment;
use App\Models\Ward;
use App\Services\SmsService;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct(public SmsService $smsService)
    {
    }

    /**
     * Display a advertise permission form.
     */
    public function applicationForm()
    {
        $wards = Ward::latest()->get();
        $banners = Banner::latest()->get();
        $documents = Document::latest()->get();

        return view('admin.advertise-permission')->with(['wards'=> $wards, 'banners'=> $banners, 'documents'=> $documents]);
    }

    public function termsCondition()
    {
        return view('frontend.terms-condition');
    }

    public function submitApplication(StoreApplicationRequest $request)
    {
        $user = Auth::user();
        $input = $request->validated();
        $input['user_id'] = $user->id;
        $input['price'] = (((25/30) * $input['days']) * ($input['length'] * $input['width']));

        try
        {
            DB::beginTransaction();
            $application = $this->saveDetailsToDB($input);
            DB::commit();

            return response()->json(['success'=> 'Application submitted successfully']);
        }
        catch(\Exception $e)
        {
            Log::info("application submission: ". $e);
            return response()->json(['error2'=> 'Something went wrong while submitting your application!']);
        }
    }

    public function cancelApplicationList()
    {
        $authUser = Auth::user();

        $applications = HoardingPermission::query()
                            ->with('ward', 'banner')
                            // ->where('status', 1)
                            ->where('from_date','>',date('Y-m-d'))
                            // ->where('from_date', '>', now()->toDateString())
                            ->withWhereHas('payment', fn ($q) =>
                                    // $q->whereIn('status', [HoardingPermissionPayment::PAYMENT_STATUS_SUCCESSFUL,HoardingPermissionPayment::PAYMENT_STATUS_CANCELLED, HoardingPermissionPayment::PAYMENT_STATUS_REFUNDED]))
                                    $q->whereIn('status', [HoardingPermissionPayment::PAYMENT_STATUS_SUCCESSFUL]))
                            ->when( $authUser->hasRole(['User']), fn ($q) => $q->where('user_id', $authUser->id) )
                            ->when( $authUser->hasRole(['Police', 'Ward']), fn ($q) => $q->where('ward_id', $authUser->ward_id) )
                            ->latest()
                            ->get();

        return view('admin.cancel-application-list')->with(['applications' => $applications]);
    }

    public function cancelApplication(Request $request, HoardingPermission $application)
    {
        if( Carbon::parse( Carbon::today()->toDateString() )->gte( Carbon::parse($application->from_date)->subDays(2)->toDateString() ) )
            return response()->json(['error2'=> 'Application can only be cancelled before 2 days of registered date']);

        try
        {
            DB::beginTransaction();

            $application->payment_status = HoardingPermissionPayment::PAYMENT_STATUS_CANCELLED;
            $application->cancel_remark = $request->cancel_remark;
            $application->cancel_date = now();

            if($application->save())
            {
                $application->payment()->update([ 'status' => HoardingPermissionPayment::PAYMENT_STATUS_CANCELLED ]);

                $paymentProvider = PaymentProviderFactory::get('easebuzz');
                $response = $paymentProvider->initiateRefund($application);
                // Mail::to($user->email)->send(new ApplicationRejectedMail($user, $application));

                $decodedResponse = json_decode($response, true);

                if (!$decodedResponse['status']) {
                    DB::rollBack();
                    return response()->json(['error2' => $decodedResponse['reason']]);
                }

                // if( !json_decode($response, true)['status'] )
                // {
                //     DB::rollBack();
                //     return ['error2'=> json_decode($response, true)['reason']];
                // }

                DB::table('location_booked_dates')->where('hoarding_permission_id', $application->id)->delete();

                DB::commit();

                return response()->json(['success'=> 'Application Cancelled successfully!']);
            }
            return response()->json(['error2'=> 'Something went wrong, please try after sometime']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'updating', 'Status');
        }
    }

    public function certificateList()
    {
        $authUser = Auth::user();

        $applications = HoardingPermission::query()
                            ->with('ward', 'banner')
                            // ->where('status', 1)
                            ->withWhereHas('payment', fn ($q) =>
                                    $q->where('status', HoardingPermissionPayment::PAYMENT_STATUS_SUCCESSFUL))
                            ->when( $authUser->hasRole(['User']), fn ($q) => $q->where('user_id', $authUser->id) )
                            ->when( $authUser->hasRole(['Police', 'Ward']), fn ($q) => $q->where('ward_id', $authUser->ward_id) )
                            ->latest()
                            ->get();

        return view('admin.certificate-list')->with(['applications' => $applications]);
    }

    public function downloadCertificate(Request $request, HoardingPermission $application)
    {
        $application = $application->load('payment', 'ward', 'banner');

        $applicationNo = $application->generateApplicationNo();

        $qrPath = $application->generateQrCode();


        $imgdata = file_get_contents(public_path($qrPath));
        $data['qr_code'] = 'data:image/svg+xml;base64,' . base64_encode($imgdata);
        $data['application'] = $application;

        $pdf = SnappyPdf::loadView('admin.pdf.certificate', $data)
                                ->setPaper('a4')
                                ->setOption('margin-bottom', 3)
                                ->setOption('margin-top', 3)
                                ->setOption('margin-left', 0)
                                ->setOption('margin-right', 0);

        return $pdf->inline('CERTIFICATE_'.$applicationNo.'.pdf');
    }


    public function qrCodeList()
    {
        $authUser = Auth::user();

        $applications = HoardingPermission::query()
                            ->with('ward', 'banner')
                            // ->where('status', 1)
                            ->withWhereHas('payment', fn ($q) =>
                                    $q->where('status', HoardingPermissionPayment::PAYMENT_STATUS_SUCCESSFUL))
                            ->when( $authUser->hasRole(['User']), fn ($q) => $q->where('user_id', $authUser->id) )
                            ->when( $authUser->hasRole(['Police', 'Ward']), fn ($q) => $q->where('ward_id', $authUser->ward_id) )
                            ->latest()
                            ->get();

        return view('admin.qr-code-list')->with(['applications' => $applications]);
    }

    public function downloadQrCode(Request $request, HoardingPermission $application)
    {
        $qrPath = $application->generateQrCode();

        return view('admin.view-qr-code')->with('qrPath', $qrPath);
    }

    public function showCertificate(HoardingPermission $application)
    {
        $application = $application->load('payment', 'ward', 'banner');

        $qrPath = $application->generateQrCode();

        $ext = pathinfo(public_path($application->banner_image), PATHINFO_EXTENSION);
        $fileData = file_get_contents(public_path($application->banner_image));
        $base64BannerString = 'data:image/' . $ext . ';base64,' . base64_encode($fileData);

        $imgdata = file_get_contents(public_path($qrPath));
        $data['qr_code'] = 'data:image/svg+xml;base64,' . base64_encode($imgdata);
        $data['application'] = $application;
        $data['banner_image'] = $base64BannerString;

        return view('frontend.show-certificate', $data);
    }


    public function getApplicationToDate($from_date)
    {
        return ['to_date' => Carbon::parse($from_date)->addDays(config('setting.gap_after_from_date'))->toDateString()];
    }
    protected function saveDetailsToDB($input)
    {
        if($input['banner_image'])
            $input['banner_image'] = 'storage/'.$input['banner_image']->store('applications');

        $application = HoardingPermission::create( Arr::only( $input, HoardingPermission::getFillables() ) );
        $application->generateApplicationNo();
        $application->payment()->create([
            'user_id' => Auth::user()->id,
            'amount_payable' => HoardingPermission::amountPayable($application),
            'date' => Carbon::today()->toDateString(),
        ]);

        // $dateRanges = CarbonPeriod::create( Carbon::parse($input['from_date']), Carbon::parse($input['to_date']) )->toArray();
        // foreach($dateRanges as $dateRange)
        //     LocationBookedDate::create([
        //         'location_id' => $input['location_id'],
        //         'user_id' => $input['user_id'],
        //         'hoarding_permission_id' => $application->id,
        //         'date' => $dateRange->toDateString(),
        //     ]);

        $documents = Document::get();
        foreach($documents as $document)
        {
            $requestFile = 'docs_'.$document->id;
            if( array_key_exists($requestFile, $input) )
            {
                $path = 'storage/'.$input[$requestFile]->store('applications');
                HoardingPermissionDoc::create([
                    'hoarding_permission_id' => $application->id,
                    'document_id' => $document->id,
                    'path' => $path,
                ]);
            }
        }

        return $application;
    }
}
