<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GradeScore extends Model
{
    //
    protected $casts = [
        'is_pass_grade' => 'boolean'
    ];
}
