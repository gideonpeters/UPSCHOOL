<?php

namespace App;

use App\File;
use App\Student;
use App\Semester;
use App\ExeatType;
use Illuminate\Database\Eloquent\Model;

class Exeat extends Model
{
    //
    public function exeat_type()
    {
        return $this->belongsTo(ExeatType::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function file()
    {
        return $this->morphMany(File::class, 'fileable');
    }
}
