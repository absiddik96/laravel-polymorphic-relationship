<?php

use Faker\Generator as Faker;

$factory->define(App\Video::class, function (Faker $faker) {
    return [
        'name' => 'Video '.$faker->name,
    ];
});
