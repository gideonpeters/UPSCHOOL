<?php

namespace App;

use App\Student;
use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    //
    public function students()
    {
        return $this->belongsToMany(Student::class);
    }
}
