<?php

namespace App;

use App\Exam;
use App\GradeItem;
use App\ResultItem;
use App\CurriculumItem;
use App\ContinuousAssessment;
use App\SchoolAssessmentItem;
use Illuminate\Database\Eloquent\Relations\Pivot;

class StudentCourse extends Pivot
{
    //
    protected $table = 'student_courses';

    protected $with = ['curriculum_item'];

    public function result_item()
    {
        return $this->hasOne(ResultItem::class, 'student_course_id');
    }

    public function school_assessments()
    {
        return $this->hasMany(SchoolAssessmentItem::class);
    }

    public function grade_items()
    {
        return $this->hasMany(GradeItem::class);
    }

    public function continuous_assessments()
    {
        return $this->hasMany(ContinuousAssessment::class);
    }

    public function examinations()
    {
        return $this->hasMany(Exam::class);
    }

    public function curriculum_item()
    {
        return $this->belongsTo(CurriculumItem::class);
    }
}
