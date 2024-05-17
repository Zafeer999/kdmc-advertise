<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HoardingPermission;
use App\Models\Ward;
use Illuminate\Http\Request;

class ReportController extends Controller
{

    public function index(Request $request)
    {
        $wards = Ward::get();

        $datas = [];
        if($request->adv_type || $request->ward || $request->from_date || $request->to_date)
        {
            $datas = HoardingPermission::query()
                            ->with('ward')
                            ->when($request->ward, fn ($q) => $q->where('ward_id', $request->ward))
                            ->when($request->adv_type, fn ($q) => $q->where('advertise_type', $request->adv_type))
                            ->when($request->from_date, fn ($q) => $q->whereDate('from_date', '>=', $request->from_date))
                            ->when($request->to_date, fn ($q) => $q->whereDate('to_date', '<=', $request->to_date))
                            ->get();

        }

        return view('admin.reports')->with(['wards' => $wards, 'datas' => $datas]);
    }
}
