<?php

namespace App;

use App\Event;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Message;
use App\UserEvent;
use App\SchoolEvent;
use App\ScheduleItem;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'name', 'email', 'password',
    // ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'userable_id', 'userable_type', 'email_verified_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userable()
    {
        return $this->morphTo();
    }

    public function schedule()
    {
        return $this->hasMany(ScheduleItem::class);
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'users_events')->using(UserEvent::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    // public function image()
    // {
    //     return $this->morphOne(File::class, 'fileable');
    // }
}
