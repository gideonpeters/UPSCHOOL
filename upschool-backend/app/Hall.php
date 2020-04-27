<?php

namespace App;

use App\Room;
use Illuminate\Database\Eloquent\Model;

class Hall extends Model
{
    //
    protected $casts = [
        'preferred_student_type' => 'array',
        'preferred_sex' => 'array',
        'preferred_program' => 'array',
        'preferred_nationality' => 'array',
        'preferred_level' => 'array',
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
