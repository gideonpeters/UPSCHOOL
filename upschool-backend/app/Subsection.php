<?php

namespace App;

use App\File;
use App\CourseSection;
use Illuminate\Database\Eloquent\Model;

class Subsection extends Model
{
    //
    public function section()
    {
        return $this->belongsTo(CourseSection::class);
    }

    public function file()
    {
        return $this->morphOne(File::class, 'fileable');
    }
}
