<?php

namespace App;

use App\Event;
use Illuminate\Database\Eloquent\Model;

class SchoolEvent extends Model
{
    //
    public function event()
    {
        return $this->morphOne(Event::class, 'eventable');
    }
}
