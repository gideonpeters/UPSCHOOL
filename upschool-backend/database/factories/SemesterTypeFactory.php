<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\SemesterType;
use Faker\Generator as Faker;

$factory->define(SemesterType::class, function (Faker $faker) {
    return [
        //
        'title' => 'Omega',
        'short_title' => 'O'
    ];
});
