<?php

namespace App\Http\Controllers\Admin\Masters;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\Masters\StorePoliceStationRequest;
use App\Http\Requests\Admin\Masters\UpdatePoliceStationRequest;
use App\Models\PoliceStation;
use App\Models\Ward;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class PoliceStationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $police_stations = PoliceStation::latest()->get();
        $wards = Ward::latest()->get();
        return view('admin.masters.police-stations')->with(['police_stations'=> $police_stations,'wards'=>$wards]);
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
    public function store(StorePoliceStationRequest $request)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            PoliceStation::create( Arr::only( $input, PoliceStation::getFillables() ) );
            DB::commit();

            return response()->json(['success'=> 'Police Station created successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'creating', 'Police Station');
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
    public function edit(PoliceStation $police_station)
    {
        $wards = Ward::latest()->get();
        if ($police_station)
        {

            $wardHtml = '<span>
                <option value="">--Select Ward--</option>';
                foreach($wards as $ward):
                    $is_select = $ward->id == $police_station->ward_id ? "selected" : "";
                    $wardHtml .= '<option value="'.$ward->id.'" '.$is_select.'>'.$ward->name.'</option>';
                endforeach;
            $wardHtml .= '</span>';

            $response = [
                'result' => 1,
                'police_station' => $police_station,
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
    public function update(UpdatePoliceStationRequest $request, PoliceStation $police_station)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            $police_station->update( Arr::only( $input, PoliceStation::getFillables() ) );
            DB::commit();

            return response()->json(['success'=> 'Police Station updated successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'updating', 'Police Station');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PoliceStation $police_station)
    {
        try
        {
            DB::beginTransaction();
            $police_station->delete();
            DB::commit();
            return response()->json(['success'=> 'Police Station deleted successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'deleting', 'Police Station');
        }
    }
}
