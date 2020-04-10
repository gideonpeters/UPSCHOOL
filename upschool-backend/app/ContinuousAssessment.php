<?php

namespace App;

use App\Course;
use App\StudentCourse;
use Illuminate\Database\Eloquent\Model;

class ContinuousAssessment extends Model
{
    //
    public function continuous_assessment()
    {
        return $this->belongsTo(ContinuousAssessment::class, 'continuous_assessment_id');
    }

    public function continuous_assessments()
    {
        return $this->hasMany(ContinuousAssessment::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
