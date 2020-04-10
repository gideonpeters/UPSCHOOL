<?php

namespace App\Http\Controllers;

use App\UserEvent;
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
        $events = UserEvent::whereUserId($request->user_id)->whereEventId(null)->get();

        $values = [];

        foreach ($events as $v => $event) {
            # code...
            array_push($values, $event->school_event());
        }

        return response()->json([
            'status' => true,
            'message' => 'these are all the school events for this user',
            'data' => $values
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

    public function edit(UserEvent $userEvent)
    {
        //
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
