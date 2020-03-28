<?php

namespace App;

use App\Program;
use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
    //
    public function programs()
    {
        return $this->hasMany(Program::class);
    }
}
