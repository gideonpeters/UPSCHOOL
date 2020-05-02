<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $fillable = ['body'];
    protected $appends = ['self_message'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getSelfMessageAttribute()
    {
        return $this->user_id === auth()->user()->id;
    }
}
