<?php

namespace App;

use App\Staff;
use App\School;
use App\College;
use App\Program;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //
    // protected $with = ['programs'];

    public function college()
    {
        return $this->belongsTo(College::class, 'college_id')->withDefault();
    }

    public function school()
    {
        return $this->belongsTo(School::class)->withDefault();
    }

    public function staff()
    {
        return $this->hasMany(Staff::class);
    }

    public function programs()
    {
        return $this->hasMany(Program::class);
    }
}
