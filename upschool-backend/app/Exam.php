<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    //
    public function event()
    {
        return $this->morphOne(Event::class, 'eventable');
    }
}
