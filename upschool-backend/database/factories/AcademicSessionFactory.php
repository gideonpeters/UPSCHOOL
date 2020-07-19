<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\AcademicSession;
use Faker\Generator as Faker;

$factory->define(AcademicSession::class, function (Faker $faker) {
    $date = new DateTime();
    return [
        //
        'title' => '2019/2020 Academic Session',
        'start_date' => $date,
        'end_date' => $date,
    ];
});
