<?php

namespace App;

use App\File;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    //
    public function image()
    {
        return $this->morphOne(File::class, 'fileable');
    }
}
