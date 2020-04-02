<?php

namespace App;

use App\Program;
use App\CurriculumItem;
use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    //
    protected $with = ['curriculum_items'];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function curriculum_items()
    {
        return $this->hasMany(CurriculumItem::class);
    }
}
