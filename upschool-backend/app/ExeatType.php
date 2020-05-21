<?php

namespace App;

use App\Exeat;
use Illuminate\Database\Eloquent\Model;

class ExeatType extends Model
{
    //
    public function exeats()
    {
        return $this->hasMany(Exeat::class);
    }
}
