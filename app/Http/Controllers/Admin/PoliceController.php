<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use App\Models\HoardingPermission;
use App\Models\HoardingPermissionDoc;
use App\Models\HoardingPermissionPayment;
use App\Mail\ApplicationApproveMail;
use App\Mail\ApplicationRejectedMail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


class PoliceController extends Controller
{
    /**
     * Display a listing of the pending permissions.
     */
    public function index($status = 0)
    {
        $authUser = Auth::user();
        $HoardingPermissions = HoardingPermission::query()
                            ->when( $authUser->hasRole(['Ward']), fn ($q) => $q->where('ward_id', $authUser->ward_id) )
                            ->when( $authUser->hasRole(['Police']), fn ($q) => $q->where('status', HoardingPermission::APPLICATION_WARD_APPROVE) )
                            // ->when( $authUser->hasRole(['User']), fn ($q) => $q->where('payment_status', '<=', ) )
                            ->when( $status == 1, fn ($query) => $query->where('payment_status', HoardingPermissionPayment::PAYMENT_STATUS_SUCCESSFUL) )
                            ->when( $status == 2, fn ($query) => $query->where('payment_status', HoardingPermissionPayment::PAYMENT_STATUS_CANCELLED) )
                            ->latest()->get();

        return view('admin.police.pending-permission')->with(['HoardingPermissions' => $HoardingPermissions, 'authUser' => $authUser,'status' => $status]);
    }

    public function wardWiseList($status,$ward_id)
    {
        $authUser = Auth::user();
        $HoardingPermissions = HoardingPermission::
                            when( $authUser->hasRole(['Admin', 'Super Admin']), fn ($q) => $q->where('ward_id', $ward_id) )
                            ->when( $status == 1, fn ($query) => $query->where('payment_status', HoardingPermissionPayment::PAYMENT_STATUS_SUCCESSFUL) )
                            ->when( $status == 2, fn ($query) => $query->where('payment_status', HoardingPermissionPayment::PAYMENT_STATUS_CANCELLED) )
                            ->latest()->get();

        return view('admin.police.pending-permission')->with(['HoardingPermissions' => $HoardingPermissions,'status' => $status]);
    }

    /**
     * Display a application form.
     */
    public function viewApplication($id)
    {
        $data = HoardingPermission::find($id);

        $documents = HoardingPermissionDoc::with('document')->where('hoarding_permission_id',$data->id)
                    ->latest()->get();

        return view('admin.police.view-application')->with(['data' => $data,'documents'=>$documents]);
    }

    /**
     * Approve a application form.
     */
    public function ApproveApplication($id)
    {
        try
        {
            $user = Auth::user();
            $data = HoardingPermission::find($id);
            $data->status = $user->hasRole(['Ward']) ? HoardingPermission::APPLICATION_WARD_APPROVE : HoardingPermission::APPLICATION_POLICE_APPROVE;
            $data->status_by = Auth::user()->id;
            $data->status_date = now();

            if($data->save())
            {
                if($user->hasRole(['Police']))
                {
                    try{
                        Mail::to($user->email)->send(new ApplicationApproveMail($user, $data));
                    }
                    catch(Exception $e)
                    {
                        Log::info("Mail send error");
                    }
                }
                return response()->json(['success'=> 'Status updated successfully!']);
            }
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'updating', 'Status');
        }
    }

    /**
     * Reject application form.
     */
    public function RejectApplication(Request $request, $id)
    {
        try
        {
            $user = Auth::user();
            $data = HoardingPermission::find($id);
            $data->status = $user->hasRole(['Ward']) ? HoardingPermission::APPLICATION_WARD_REJECT : HoardingPermission::APPLICATION_POLICE_REJECT;
            $data->reject_remark = $request->reject_remark;
            $data->status_by = Auth::user()->id;
            $data->status_date = now();

            if($data->save())
            {
                if($user->hasRole(['Police']))
                {
                    try{
                        Mail::to($user->email)->send(new ApplicationRejectedMail($user, $data));
                    }
                    catch(Exception $e)
                    {
                        Log::info("Mail send error");
                    }
                }
                return response()->json(['success'=> 'Status updated successfully!']);
            }
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'updating', 'Status');
        }
    }


}
