<?php

namespace App;

use App\User;
use App\SchoolEvent;
use Illuminate\Database\Eloquent\Model;

class UserEvent extends Model
{
    //
    protected $table = 'users_events';

    public function school_event()
    {
        return SchoolEvent::whereId($this->school_event_id)->first();
    }

    public function user()
    {
        return User::whereId($this->user_id)->first();
    }
}
