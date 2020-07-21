<?php

namespace App;

use App\User;
use App\Message;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    //
    protected $appends = ['title', 'last_message', 'last_sent'];
    protected $with = ['messages'];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function getTitleAttribute()
    {
        return $this->name && count($this->users) > 2 ? $this->name : $this->users->whereNotIn('id', [auth()->user()->id])->first()->name;
    }

    public function getLastMessageAttribute()
    {
        return $this->messages()->latest()->first()->body;
    }

    public function getLastSentAttribute()
    {
        return $this->messages()->latest()->first()->created_at;
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_conversations');
    }
}
