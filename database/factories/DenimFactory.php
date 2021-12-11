<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Denim;
use Faker\Generator as Faker;

$factory->define(Denim::class, function (Faker $faker) {

    $denims = [
        'nudiejeans',
        'levis',
        'momotarojeans',
        'resolt',
        'japanbluejeans',
        'denham',
        'benzakdenimdevelopers',
        'evisu',
    ];

    return [
        'user_id'       => factory(App\User::class),
        'bland_type'    => $faker->randomElement($denims),
        'waist'         => $faker->numberBetween(25, 40),
        'wearing_count' => $faker->numberBetween(0, 100),
    ];
});
