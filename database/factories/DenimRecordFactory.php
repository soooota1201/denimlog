<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\DenimRecord;
use Faker\Generator as Faker;

$factory->define(DenimRecord::class, function (Faker $faker) {

    return [
        'user_id' => factory(App\User::class),
        'wearing_day' => $faker->date,
        'wearing_place' => 'Osaka',
        'body' => $faker->text,
        'bland_type' => factory(App\Denim::class)
    ];
});
