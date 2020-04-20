<?php

namespace App;

use App\Course;
use App\Subsection;
use Illuminate\Database\Eloquent\Model;

class CourseSection extends Model
{
    //
    protected $casts  = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function subsections()
    {
        return $this->hasMany(Subsection::class);
    }
}
