<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolAssessment extends Model
{
    //
    protected $casts = [
        'visible' => 'boolean'
    ];
}
