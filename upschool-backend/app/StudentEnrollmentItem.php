<?php

namespace App;

use App\Student;
use App\CurriculumItem;
use Illuminate\Database\Eloquent\Model;

class StudentEnrollmentItem extends Model
{
    //
    protected $with = ['curriculum_item'];

    public function curriculum_item()
    {
        return $this->belongsTo(CurriculumItem::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
