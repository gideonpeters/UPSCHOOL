<?php

namespace App;

use App\Gradelist;
use App\Subsection;
use Illuminate\Database\Eloquent\Model;

class SubmissionList extends Model
{
    //
    public function gradelist()
    {
        return $this->belongsTo(Gradelist::class);
    }

    public function subsection()
    {
        return $this->belongsTo(Subsection::class);
    }
}
