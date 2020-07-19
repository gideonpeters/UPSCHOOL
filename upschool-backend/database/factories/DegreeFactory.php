<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Degree;
use Faker\Generator as Faker;

$factory->define(Degree::class, function (Faker $faker) {
    return [
        //
        'name' => 'Bachelor of Engineering',
        'short_name' => 'B.Eng.',
        'type' => 'bachelors',
        'category' => 'undergraduate'
    ];
});
