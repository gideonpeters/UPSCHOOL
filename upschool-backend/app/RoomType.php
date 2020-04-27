<?php

namespace App;

use App\Room;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    //
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
