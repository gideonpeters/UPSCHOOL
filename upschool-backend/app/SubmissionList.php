<?php

namespace App;

use App\Gradelist;
use App\Subsection;
use App\SubmissionItem;
use Illuminate\Database\Eloquent\Model;

class SubmissionList extends Model
{
    //
    protected $appends = ['submission_status'];

    public function getSubmissionStatusAttribute()
    {
        $user = auth()->user();
        if ($user) {
            if ($user->userable_type == 'App\Student') {
                $student_course_id = StudentCourse::whereCourseId($this->course_id)->whereStudentId($user->userable_id)->first()->id;
                $submitted = SubmissionItem::whereStudentCourseId($student_course_id)->whereSubmissionListId($this->id)->exists();
                return $submitted;
            }
        }
        return false;
    }

    public function gradelist()
    {
        return $this->belongsTo(Gradelist::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function subsection()
    {
        return $this->belongsTo(Subsection::class);
    }

    public function submission_items()
    {
        return $this->hasMany(SubmissionItem::class);
    }
}
