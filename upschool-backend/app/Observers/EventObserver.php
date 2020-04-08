<?php

namespace App\Observers;

use App\Event;
use App\Semester;
use Illuminate\Support\Carbon;

class EventObserver
{
    public function created(Event $event)
    {
        //
        $currentSemester = Semester::latest()->first();
        $today = Carbon::now();
        $end = Carbon::parse($currentSemester->end_date);

        $diffDays = date_diff($today, $end)->format('%a');
        $diffWeeks = floor($diffDays / 7);
        $diffMonths = date_diff($today, $end)->format('%m');

        if (!$event->event()->exists()) {
            $recurrences = [
                'daily'     => [
                    'times'     => $diffDays,
                    'function'  => 'addDay'
                ],
                'weekly'    => [
                    'times'     => $diffWeeks,
                    'function'  => 'addWeek'
                ],
                'monthly'    => [
                    'times'     => $diffMonths,
                    'function'  => 'addMonth'
                ]
            ];

            $startTime = Carbon::parse($event->start_time);
            $endTime = Carbon::parse($event->end_time);
            $recurrence = $recurrences[$event->recurrence] ?? null;

            if ($recurrence) {

                for ($i = 0; $i < $recurrence['times']; $i++) {
                    $startTime->{$recurrence['function']}();
                    $endTime->{$recurrence['function']}();
                    $event->events()->create([
                        // 'title'          => $event->title,
                        'start_time'    => $startTime,
                        'end_time'      => $endTime,
                        'recurrence'    => $event->recurrence,
                        'venue' => $event->venue,
                        'eventable_type' => $event->eventable_type,
                        'eventable_id' => $event->eventable_id,
                        'semester_id' => $currentSemester->id,
                        'date' => $event->date,
                    ]);
                }
            }
        }
    }

    public function updated(Event $event)
    {
        //
        if ($event->events()->exists() || $event->event) {
            $startTime = Carbon::parse($event->getOriginal('start_time'))->diffInSeconds($event->start_time, false);
            $endTime = Carbon::parse($event->getOriginal('end_time'))->diffInSeconds($event->end_time, false);
            if ($event->event)
                $childEvents = $event->event->events()->whereDate('start_time', '>', $event->getOriginal('start_time'))->get();
            else
                $childEvents = $event->events;

            foreach ($childEvents as $childEvent) {
                if ($startTime)
                    $childEvent->start_time = Carbon::parse($childEvent->start_time)->addSeconds($startTime);
                if ($endTime)
                    $childEvent->end_time = Carbon::parse($childEvent->end_time)->addSeconds($endTime);
                // if ($event->isDirty('name') && $childEvent->name == $event->getOriginal('name'))
                //     $childEvent->name = $event->name;
                $childEvent->saveQuietly();
            }
        }

        if ($event->isDirty('recurrence') && $event->recurrence != 'none')
            self::created($event);
    }

    public function deleted(Event $event)
    {
        //
        if ($event->events()->exists())
            $events = $event->events()->pluck('id');
        else if ($event->event)
            $events = $event->event->events()->whereDate('start_time', '>', $event->start_time)->pluck('id');
        else
            $events = [];

        Event::whereIn('id', $events)->delete();
    }

    public function restored(Event $event)
    {
        //
    }

    public function forceDeleted(Event $event)
    {
        //
    }
}
