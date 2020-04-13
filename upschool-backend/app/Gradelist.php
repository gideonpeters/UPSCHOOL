<?php

namespace App;

use App\Course;
use App\Semester;
use Illuminate\Database\Eloquent\Model;

class Gradelist extends Model
{
    //
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }
}
