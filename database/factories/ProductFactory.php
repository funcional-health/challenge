<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $faker->addProvider(new \Bezhanov\Faker\Provider\Commerce($faker));

    return [
        'name' => $faker->productName,
        'industry_id' => $faker->randomElement(\App\Industry::all()->pluck('id')->toArray()),
        'price' => mt_rand (2000 * 100, 1000000 * 100) / 100,
        'stock' => rand(0, 1000),
    ];
});
