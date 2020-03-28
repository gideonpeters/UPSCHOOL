<?php

namespace App;

use App\College;
use App\Department;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    //
    public function college()
    {
        return $this->belongsTo(College::class)->withDefault();
    }

    public function departments()
    {
        return $this->hasMany(Department::class);
    }
}
