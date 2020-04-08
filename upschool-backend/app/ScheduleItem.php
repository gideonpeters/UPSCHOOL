<?php

namespace App;

use App\User;
use App\Event;
use App\Semester;
use Illuminate\Database\Eloquent\Model;

class ScheduleItem extends Model
{
    //
    protected $with = ['event'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function event()
    {
        return $this->morphOne(Event::class, 'eventable');
    }
}
