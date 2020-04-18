<?php

namespace App\Http\Controllers;

use App\ScheduleItem;
use Illuminate\Http\Request;

class ScheduleItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\ScheduleItem  $scheduleItem
     * @return \Illuminate\Http\Response
     */
    public function show(ScheduleItem $scheduleItem)
    {
        //
        $userId = auth()->user()->id;

        if (!$userId) {
            return;
        }

        $schedule = ScheduleItem::whereUserId($userId)->get();

        return response()->json([
            'status' => true,
            'message' => 'this is your schedule',
            'data' => $schedule
        ], 201);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ScheduleItem  $scheduleItem
     * @return \Illuminate\Http\Response
     */
    public function edit(ScheduleItem $scheduleItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ScheduleItem  $scheduleItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ScheduleItem $scheduleItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ScheduleItem  $scheduleItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(ScheduleItem $scheduleItem)
    {
        //
    }
}
