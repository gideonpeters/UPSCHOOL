<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Student;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
    return [
        //
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'matric_number' => Str::random(10),
        'reg_number' => Str::random(7),
        'program_id' => 1,
        'level' => '100'
    ];
});
