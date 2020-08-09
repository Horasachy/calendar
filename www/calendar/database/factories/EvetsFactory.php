<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\CalendarEvent;
use Faker\Generator as Faker;

$factory->define(CalendarEvent::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'cost' => $faker->randomNumber(),
        'type' => $faker->lastName,
        'event_at' => $faker->dateTimeThisMonth,
        'work_shift' => random_int(0, 2)
    ];
});
