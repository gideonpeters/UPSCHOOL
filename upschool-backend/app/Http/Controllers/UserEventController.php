<?php

namespace App\Http\Controllers;

use App\Event;
use App\Staff;
use App\Student;
use App\UserEvent;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserEventController extends Controller
{
    public function index()
    {
        //
    }

    public function getUserEvents(Request $request)
    {
        //
        // dd('hi');
        if ($request->type == 'student') {
            $student = Student::whereMatricNumber($request->user_id)->orWhere('id', $request->user_id)->first();
        } else {
            $student = Staff::whereStaffNumber($request->user_id)->orWhere('id', $request->user_id)->first();
        }
        $user_events = UserEvent::with('event')->whereUserId($student->user->id)->get();

        $eventIds = collect($user_events)->unique()->map(function ($item) {
            return $item->event->eventable->event_id === null ? $item->id : null;
        })->all();

        $events = Event::whereNull('event_id')->whereIn('id', $eventIds)->get();
        $events->each(function ($item) {
            $item->append('logged_dates', 'events_count');
        });

        return response()->json([
            'status' => true,
            'message' => 'these are all the school events for this user',
            'data' => $events->makeHidden('events')
        ], 201);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(UserEvent $userEvent)
    {
        //
    }

    public function participants(Request $request, $event_id)
    {
        //
        $events = Event::whereEventId($event_id);


        if ($request->has('date')) {
            $events = $events->whereStartTime($request->date);
            $eventIds = collect($events)->map(function ($item) {
                return $item->id;
            })->all();
            if ($request->type == 'student') {
                $participants = UserEvent::whereInEventId($eventIds)->get;
                $participants = $participants->each(function ($item) {
                    return $item->user->userable_type == 'App\Student';
                });
            } else if ($request->type == 'staff') {
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'these are all the participants for this event',
            'data' => $participants
        ], 201);
    }

    public function update(Request $request, UserEvent $userEvent)
    {
        //
    }

    public function destroy(UserEvent $userEvent)
    {
        //
    }
}
