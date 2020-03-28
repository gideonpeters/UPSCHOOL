<?php

namespace App;

use App\Semester;
use Illuminate\Database\Eloquent\Model;

class AcademicSession extends Model
{
    //
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function semesters()
    {
        return $this->hasMany(Semester::class);
    }
}
