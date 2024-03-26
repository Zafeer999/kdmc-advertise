<?php

namespace App\Http\Controllers\Admin\Masters;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\Masters\StoreLocationRequest;
use App\Http\Requests\Admin\Masters\UpdateLocationRequest;
use App\Models\HoardingPermission;
use App\Models\Location;
use App\Models\LocationBookedDate;
use App\Models\Ward;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations = Location::latest()->get();
        $wards = Ward::latest()->get();
        return view('admin.masters.locations')->with(['locations'=> $locations,'wards'=>$wards]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLocationRequest $request)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            Location::create( Arr::only( $input, Location::getFillables() ) );
            DB::commit();

            return response()->json(['success'=> 'Location created successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'creating', 'Location');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Location $location)
    {
        $wards = Ward::latest()->get();
        if ($location)
        {
            $wardHtml = '<span>
                <option value="">--Select Ward--</option>';
                foreach($wards as $ward):
                    $is_select = $ward->id == $location->ward_id ? "selected" : "";
                    $wardHtml .= '<option value="'.$ward->id.'" '.$is_select.'>'.$ward->name.'</option>';
                endforeach;
            $wardHtml .= '</span>';

            $response = [
                'result' => 1,
                'location' => $location,
                'wardHtml' => $wardHtml,
            ];
        }
        else
        {
            $response = ['result' => 0];
        }
        return $response;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLocationRequest $request, Location $location)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            $location->update( Arr::only( $input, Location::getFillables() ) );
            DB::commit();

            return response()->json(['success'=> 'Location updated successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'updating', 'Location');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        try
        {
            DB::beginTransaction();
            $location->delete();
            DB::commit();
            return response()->json(['success'=> 'Location deleted successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'deleting', 'Location');
        }
    }


    public function locationWiseFromdate(Request $request, Location $location)
    {
        $fromDate = Carbon::today()->addDays(config('setting.interval_days'))->toDateString();
        $toDate = Carbon::parse($fromDate)->addMonth()->toDateString();
        $dateRanges = CarbonPeriod::create( Carbon::parse($fromDate), Carbon::parse($toDate) )->toArray();
        $newDateArray = [];
        foreach($dateRanges as $dateRange)
            $newDateArray[] = $dateRange->toDateString();

        $locationBookingDates = LocationBookedDate::where('payment_status', 0)->where('location_id', $location->id)->pluck('date')->toArray();

        $newDateArray = array_diff($newDateArray, $locationBookingDates);

        $dateHtml = '<span>
            <option value="">Select Date</option>';
            foreach($newDateArray as $date):
                $dateHtml .= '<option value="'.$date.'" >'.$date.'</option>';
            endforeach;
        $dateHtml .= '</span>';

        return [ 'result' => 1, 'dateHtml' => $dateHtml ];
    }


}