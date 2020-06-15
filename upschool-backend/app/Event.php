<?php

namespace App;

use App\User;
use App\Semester;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    // 
    protected $guarded = [];
    protected $appends = ['name'];

    protected $casts = ['priority' => 'boolean'];

    public function getNameAttribute()
    {
        $item = Event::with('eventable')->find($this->id);
        return $item->eventable->title;
    }

    public function getDatesAttribute()
    {
        // if (!$this->event_id) {
        $dates = collect($this->events)->map(function ($item) {
            return $item->start_time;
        });
        $dates = $dates->filter(function ($item) {
            return Carbon::parse($item)->lessThanOrEqualTo(Carbon::now());
        });

        return $dates;
        // }
    }

    public function getLoggedDatesAttribute()
    {
        $val = $this->events->filter(function ($item) {
            return Carbon::parse($item->start_time)->lessThanOrEqualTo(Carbon::now());
        })->all();

        return $val;
    }

    // public function getDefaultsAttribute()
    // {
    //     $val = $this->events->filter(function ($item) {
    //         return Carbon::parse($item->start_time)->lessThanOrEqualTo(Carbon::now());
    //     })->all();

    //     return count($val);
    // }

    public function getEventsCountAttribute()
    {
        return count($this->events);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function eventable()
    {
        return $this->morphTo();
    }
}
