<?php

namespace App\Http\Controllers;

use App\Event;
use App\SchoolEvent;
use Illuminate\Http\Request;

class SchoolEventController extends Controller
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

    public function store(Request $request)
    {
        //
        $schoolEvent = new SchoolEvent();
        $schoolEvent->title = $request->title;
        $schoolEvent->description = $request->description;

        $schoolEvent->save();

        $event = new Event();
        $event->start_time = $request->start_time;
        $event->end_time = $request->end_time;
        $event->venue = $request->venue;
        $event->recurrence = $request->recurrence;
        $event->date = $request->date;
        $event->eventable_id = $schoolEvent->id;
        $event->eventable_type = 'App\SchoolEvent';

        $event->save();

        return response()->json([
            'status' => true,
            'message' => 'school event created successfully',
            'data' => $schoolEvent->load('event')
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SchoolEvent  $schoolEvent
     * @return \Illuminate\Http\Response
     */
    public function show(SchoolEvent $schoolEvent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SchoolEvent  $schoolEvent
     * @return \Illuminate\Http\Response
     */
    public function edit(SchoolEvent $schoolEvent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SchoolEvent  $schoolEvent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SchoolEvent $schoolEvent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SchoolEvent  $schoolEvent
     * @return \Illuminate\Http\Response
     */
    public function destroy(SchoolEvent $schoolEvent)
    {
        //
    }
}
