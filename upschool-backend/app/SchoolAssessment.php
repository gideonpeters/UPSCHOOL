<?php

namespace App;

use App\Course;
use App\SchoolAssessmentItem;
use Illuminate\Database\Eloquent\Model;

class SchoolAssessment extends Model
{
    //
    protected $casts = [
        'visible' => 'boolean'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function school_assessment_items()
    {
        return $this->hasMany(SchoolAssessmentItem::class);
    }
}
