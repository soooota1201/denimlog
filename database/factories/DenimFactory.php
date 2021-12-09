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
        'bland_type'    => $faker->randomElement($denims),
        'waist'         => $faker->randomNumber(),
        'wearing_count' => $faker->randomNumber(),
    ];
});
