<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    //
    protected $appends = ['type'];
    protected $with = ['user'];

    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function getTypeAttribute()
    {
        return 'admin';
    }
}
