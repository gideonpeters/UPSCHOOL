<?php

namespace App\Http\Controllers;

use App\Event;
use App\UserEvent;
use App\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
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
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $event_id)
    {
        //
        $events = Event::whereEventId($event_id);

        $participants = [];


        if ($request->has('date')) {
            $events = $events->whereStartTime($request->date)->get();
            $eventIds = $events->map(function ($item) {
                return $item->id;
            })->all();
            $participants = UserEvent::whereIn('event_id', $eventIds)->get();
            if ($request->type == 'student') {
                $participants = $participants->filter(function ($item) {
                    return $item->user->userable_type == 'App\Student';
                });
            } else if ($request->type == 'staff') {
                $participants = $participants->filter(function ($item) {
                    return $item->user->userable_type == 'App\Staff';
                });
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'these are all the participants for this event',
            'data' => $participants->load('user.userable')
        ], 201);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        if ($request->has('action')) {
            if ($request->has('multiple')) {
                $user_events = UserEvent::findMany(json_decode($request->ids, true));

                $user_events->each(function ($item) use ($request) {
                    $item->status = $request->status;
                    $item->save();
                });

                return response()->json([
                    'status' => true,
                    'message' => 'attendances updated successfully',
                    'data' => $user_events,
                    'more' => json_decode($request->ids, true)
                ], 201);
            }
            $user_event = UserEvent::find($id);

            if (!$user_event) {
                return response()->json([
                    'status' => false,
                    'message' => 'participant not found',
                    'data' => null
                ], 201);
            }
            $user_event->status = $request->status;
            $user_event->save();

            return response()->json([
                'status' => true,
                'message' => 'attendance updated successfully',
                'data' => $user_event
            ], 201);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        //
    }
}
