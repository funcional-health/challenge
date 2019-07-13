<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Industry;
use Faker\Generator as Faker;

$factory->define(Industry::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
