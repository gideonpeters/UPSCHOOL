<?php

namespace App;

use App\Course;
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
}
