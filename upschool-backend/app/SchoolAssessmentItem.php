<?php

namespace App;

use App\SchoolAssessment;
use Illuminate\Database\Eloquent\Model;

class SchoolAssessmentItem extends Model
{
    //
    protected $with = ['school_assessment:id,name,total_score'];

    public function school_assessment()
    {
        return $this->belongsTo(SchoolAssessment::class);
    }

    public function student_course()
    {
        return $this->belongsTo(StudentCourse::class, 'student_course_id');
    }
}
