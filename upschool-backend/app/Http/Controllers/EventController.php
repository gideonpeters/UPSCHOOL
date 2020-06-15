<?php

namespace App\Http\Controllers;

use App\Event;
use App\Semester;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $currentSemester = Semester::latest()->first();
        $events = Event::with('eventable')->whereNotNull('event_id')->whereSemesterId($currentSemester->id);

        return response()->json([
            'status' => true,
            'message' => 'these are all the events',
            'data' => $events->get()
        ], 201);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Event $event, $event_id)
    {
        //
        $event = Event::with('eventable')->find($event_id);

        if (!$event) {
            return response()->json([
                'status' => false,
                'message' => 'event does not exist',
                'data' => []
            ], 201);
        }

        $event->append('dates');

        return response()->json([
            'status' => true,
            'message' => 'this is the event',
            'data' => $event
        ], 201);
    }

    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }
}
