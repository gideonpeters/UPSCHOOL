<?php

namespace App;

use App\Program;
use App\CourseStatus;
use App\CurriculumItem;
use Illuminate\Database\Eloquent\Model;

class CurriculumBlock extends Model
{
    //
    protected $with = ['status:id,name,short_name', 'program:id,name'];

    public function curriculum_items()
    {
        return $this->hasMany(CurriculumItem::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function status()
    {
        return $this->belongsTo(CourseStatus::class, 'course_status_id');
    }
}
