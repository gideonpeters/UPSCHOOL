<?php

namespace App;

use App\Student;
use App\Semester;
use App\CurriculumItem;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    //
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function curriculum_items()
    {
        return $this->belongsToMany(CurriculumItem::class, 'enrollments_curriculum_items', 'enrollment_id', 'curriculum_item_id');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }
}
