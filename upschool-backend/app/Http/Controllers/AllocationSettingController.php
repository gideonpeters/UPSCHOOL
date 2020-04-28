<?php

namespace App\Http\Controllers;

use App\AllocationSetting;
use Illuminate\Http\Request;

class AllocationSettingController extends Controller
{

    public function index()
    {
        //
        $settings = AllocationSetting::latest()->first();

        if (!$settings) {
            $settings = new AllocationSetting();
            $settings->save();
        }

        return response()->json([
            'status' => true,
            'message' => 'these are all the allocation settings',
            'data' => $settings
        ], 201);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AllocationSetting  $allocationSetting
     * @return \Illuminate\Http\Response
     */
    public function show(AllocationSetting $allocationSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AllocationSetting  $allocationSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(AllocationSetting $allocationSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AllocationSetting  $allocationSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AllocationSetting $allocationSetting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AllocationSetting  $allocationSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(AllocationSetting $allocationSetting)
    {
        //
    }
}
