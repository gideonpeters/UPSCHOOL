<?php

namespace App;

use App\Exam;
use App\ResultItem;
use App\ContinuousAssessment;
use Illuminate\Database\Eloquent\Relations\Pivot;

class StudentCourse extends Pivot
{
    //
    protected $table = 'student_courses';

    public function result_item()
    {
        return $this->hasOne(ResultItem::class);
    }

    public function continuous_assessments()
    {
        return ContinuousAssessment::whereStudentId($this->student_id)
            ->whereCourseId($this->course_id)
            ->get();
    }

    public function examinations()
    {
        return $this->hasMany(Exam::class);
    }
}
