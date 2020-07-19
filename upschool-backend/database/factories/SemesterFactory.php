<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Semester;
use Faker\Generator as Faker;

$factory->define(Semester::class, function (Faker $faker) {
    $date = new DateTime();
    return [
        //
        'semester_type_id' => 2,
        'academic_session_id' => 1,
        'start_date' => $date,
        'end_date' => $date,
    ];
});
