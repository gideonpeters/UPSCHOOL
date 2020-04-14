<?php

namespace App;

use App\Gradelist;
use Illuminate\Database\Eloquent\Model;

class GradeItem extends Model
{
    //
    public function gradelist()
    {
        return $this->belongsTo(Gradelist::class);
    }
}
