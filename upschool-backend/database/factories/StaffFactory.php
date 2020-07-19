<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Staff;
use Faker\Generator as Faker;

$factory->define(Staff::class, function (Faker $faker) {
    return [
        //
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'staff_number' => Str::random(10),
        'department_id' => 1,
    ];
});
