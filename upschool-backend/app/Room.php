<?php

namespace App;

use App\Hall;
use App\Student;
use App\RoomType;
use App\StudentRoom;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    //

    protected $casts = [
        'preferred_sex' => 'array',
        'preferred_program' => 'array',
        'preferred_nationality' => 'array',
        'preferred_student_type' => 'array',
        'preferred_level' => 'array',
    ];

    public function hall()
    {
        return $this->belongsTo(Hall::class);
    }

    public function room_type()
    {
        return $this->belongsTo(RoomType::class);
    }

    public function occupants()
    {
        return $this->belongsToMany(Student::class, 'student_rooms')->using(StudentRoom::class);
    }
}
