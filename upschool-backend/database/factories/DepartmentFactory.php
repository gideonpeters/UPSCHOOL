<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Department;
use Faker\Generator as Faker;

$factory->define(Department::class, function (Faker $faker) {
    return [
        //
        'name' => 'Department of Electrical and Information Engineering',
        'short_name' => 'EIE',
        'college_id' => 1,
    ];
});
