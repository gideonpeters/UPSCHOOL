<?php

namespace App;

use App\User;
use App\Semester;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    // 
    protected $guarded = [];
    protected $appends = ['name'];

    public function getNameAttribute()
    {
        $item = Event::with('eventable')->find($this->id);
        return $item->eventable->title;
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
