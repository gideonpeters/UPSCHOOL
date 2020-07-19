<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Program;
use Faker\Generator as Faker;

$factory->define(Program::class, function (Faker $faker) {
    return [
        //
        'name' => 'Computer Engineering',
        'short_name' => 'CEN',
        'department_id' => 1,
        'no_of_years' => 5,
        'degree_id' => 1,
        'min_graduation_units' => 215
    ];
});
