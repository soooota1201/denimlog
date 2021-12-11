<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Denim;
use App\DenimRecord;
use Faker\Generator as Faker;

$factory->define(DenimRecord::class, function (Faker $faker) {
    $denim = new Denim();

    return [
        'user_id'       => 1,
        'denim_id'      => 1,
        'wearing_day'   => $faker->date,
        'wearing_place' => 'Osaka',
        'body'          => $faker->text,
        'bland_type'    => 'nudiejeans'
    ];
});
