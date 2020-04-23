<?php

namespace App;

use App\Course;
use App\Semester;
use App\GradeItem;
use Illuminate\Database\Eloquent\Model;

class Gradelist extends Model
{
    //
    protected $with = ['course'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function grade_items()
    {
        return $this->hasMany(GradeItem::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }
}
