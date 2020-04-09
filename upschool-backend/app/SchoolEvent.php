<?php

namespace App;

use App\Event;
use Illuminate\Database\Eloquent\Model;

class SchoolEvent extends Model
{
    //
    // protected $with = ['event'];

    public function event()
    {
        return $this->morphOne(Event::class, 'eventable');
    }

    // public function users()
    // {
    //     return $this->belongsToMany(User::class);
    // }
}
