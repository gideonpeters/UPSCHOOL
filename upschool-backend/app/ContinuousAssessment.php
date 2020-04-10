<?php

namespace App;

use App\Course;
use App\Semester;
use App\StudentCourse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function student_course()
    {
        return $this->belongsTo(StudentCourse::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id');
    }
}
