<?php

namespace App;

use App\Result;
use App\Student;
use App\Semester;
use App\CurriculumItem;
use Illuminate\Database\Eloquent\Model;

class ResultItem extends Model
{
    //
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function curriculum_item()
    {
        return $this->belongsTo(CurriculumItem::class);
    }
}
