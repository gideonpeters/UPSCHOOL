<?php

namespace App;

use App\Semester;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    // 
    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function eventable()
    {
        return $this->morphTo();
    }
}
