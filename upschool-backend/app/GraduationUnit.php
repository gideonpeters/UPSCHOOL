<?php

namespace App;

use App\Program;
use App\CourseStatus;
use Illuminate\Database\Eloquent\Model;

class GraduationUnit extends Model
{
    //
    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function courseStatus()
    {
        return $this->belongsTo(CourseStatus::class);
    }
}
