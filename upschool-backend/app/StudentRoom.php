<?php

namespace App;

use App\Room;
use App\Student;
use App\Semester;
use App\AcademicSession;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class StudentRoom extends Pivot
{
    // 
    protected $table = 'student_rooms';

    protected $casts = [
        'has_key' => 'boolean',
        'is_reserved' => 'boolean',
        'is_signed_in' => 'boolean',
        'is_signed_out' => 'boolean'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function getRoomMatesAttribute()
    {
        $student_room = StudentRoom::find($this->id);
        $student_rooms = StudentRoom::whereSessionId($student_room->session_id)->whereSemesterId($student_room->semester_id)->whereRoomId($student_room->room_id)->whereNotIn('id', [$student_room->id])->get();
        return $student_rooms->load('student');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function session()
    {
        return $this->belongsTo(AcademicSession::class, 'session_id');
    }
}
