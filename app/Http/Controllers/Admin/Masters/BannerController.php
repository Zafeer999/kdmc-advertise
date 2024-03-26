<?php

namespace App\Http\Controllers\Admin\Masters;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Masters\StoreBannerRequest;
use App\Http\Requests\Admin\Masters\UpdateBannerRequest;
use App\Models\Banner;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::latest()->get();
        return view('admin.masters.banners')->with(['banners'=> $banners]);
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
    public function store(StoreBannerRequest $request)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            Banner::create( Arr::only( $input, Banner::getFillables() ) );
            DB::commit();

            return response()->json(['success'=> 'Banner Details created successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'creating', 'Banner Details');
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
    public function edit(Banner $banner)
    {
        if ($banner)
        {
            $response = [
                'result' => 1,
                'banner' => $banner
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
    public function update(UpdateBannerRequest $request, Banner $banner)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            $banner->update( Arr::only( $input, Banner::getFillables() ) );
            DB::commit();

            return response()->json(['success'=> 'Banner Details updated successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'updating', 'Banner Details');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        try
        {
            DB::beginTransaction();
            $banner->delete();
            DB::commit();
            return response()->json(['success'=> 'Banner Details deleted successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'deleting', 'Banner Details');
        }
    }

}
