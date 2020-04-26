<?php

namespace App;

use App\File;
use App\Student;
use App\GradeItem;
use App\SubmissionList;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class SubmissionItem extends Model
{
    //
    protected $with = ['grade_item', 'file'];
    protected $appends = ['grade_status', 'student'];

    public function getGradeStatusAttribute()
    {
        $grade_item = GradeItem::find($this->grade_item_id);

        if ($grade_item->score) {
            return true;
        }
        return false;
    }

    public function getStudentAttribute()
    {
        $student_course = DB::table('student_courses')->whereId($this->student_course_id)->first();
        $student = Student::find($student_course->student_id);
        return $student;
    }

    public function submission_list()
    {
        return $this->belongsTo(SubmissionList::class);
    }

    public function file()
    {
        return $this->morphOne(File::class, 'fileable');
    }

    public function grade_item()
    {
        return $this->belongsTo(GradeItem::class);
    }
}
