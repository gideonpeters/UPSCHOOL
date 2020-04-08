<?php

namespace App;

use App\User;
use App\Event;
use App\Semester;
use Illuminate\Database\Eloquent\Model;

class ScheduleItem extends Model
{
    //
    public function user()
    {
        return $this->belongsToMany(User::class);
    }

    public function event()
    {
        return $this->belongsToMany(Event::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }
}
