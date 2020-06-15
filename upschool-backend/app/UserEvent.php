<?php

namespace App;

use App\User;
use App\SchoolEvent;
use Illuminate\Database\Eloquent\Model;

class UserEvent extends Model
{
    //
    protected $table = 'users_events';
    protected $appends = ['presence'];
    protected $cast = ['status' => 'boolean'];

    public function school_event()
    {
        return $this->belongsTo(SchoolEvent::class, 'school_event_id');
    }

    public function getPresenceAttribute()
    {
        $res = '';
        if ($this->status === null) {
            $res = 'pending';
        } else if ($this->status == false) {
            $res = 'absent';
        } else if ($this->status == true) {
            $res = 'present';
        }
        return $res;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}
