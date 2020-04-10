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
        return $this->hasMany(ContinuousAssessment::class);
    }

    public function examinations()
    {
        return $this->hasMany(Exam::class);
    }
}
