<?php

namespace App;

use App\ScheduleItem;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    // 
    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function schedule_item()
    {
        return $this->hasOne(ScheduleItem::class);
    }
}
