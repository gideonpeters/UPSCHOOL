<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AllocationSetting extends Model
{
    //

    protected $casts = [
        'allocate_after_pay' => 'boolean',
        'allocate_personal' => 'boolean',
        'allocate_school' => 'boolean',
        'allocate_by_semester' => 'boolean',
        'allocate_by_session' => 'boolean',
        'allocate_by_sex' => 'boolean',
        'allocate_by_level' => 'boolean',
        'allocate_by_program' => 'boolean',
        'allocate_by_student_type' => 'boolean',
        'allocate_by_nationality' => 'boolean',
        'allocate_reservable' => 'boolean'
    ];
}
