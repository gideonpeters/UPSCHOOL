<?php

namespace App;

use App\Result;
use App\CurriculumItem;
use Illuminate\Database\Eloquent\Model;

class ResultItem extends Model
{
    //
    public function result()
    {
        return $this->belongsTo(Result::class);
    }

    public function curriculum_item()
    {
        return $this->belongsTo(CurriculumItem::class);
    }
}
