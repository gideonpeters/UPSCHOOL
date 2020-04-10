<?php

namespace App;

use App\Student;
use App\Semester;
use App\ResultItem;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    //
    // public function student()
    // {
    //     return $this->belongsTo(Student::class);
    // }
    protected $with = ['semester', 'result_items'];

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function result_items()
    {
        return $this->hasMany(ResultItem::class);
    }
}
