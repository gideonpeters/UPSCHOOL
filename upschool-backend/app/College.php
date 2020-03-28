<?php

namespace App;

use App\School;
use App\Department;
use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    //
    // protected $with = ['departments'];

    public function departments($hasSchools)
    {
        return $hasSchools ?  $this->hasManyThrough(Department::class, School::class) : $this->hasMany(Department::class);
    }

    public function schools()
    {
        return $this->hasMany(School::class);
    }
}
