<?php

namespace App;

use App\File;
use App\CourseSection;
use App\SubmissionList;
use Illuminate\Database\Eloquent\Model;

class Subsection extends Model
{
    //
    protected $with = ['file', 'submission_list'];

    public function section()
    {
        return $this->belongsTo(CourseSection::class);
    }

    public function submission_list()
    {
        return $this->hasOne(SubmissionList::class);
    }

    public function file()
    {
        return $this->morphOne(File::class, 'fileable');
    }
}
