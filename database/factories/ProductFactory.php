<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name(),
        'price' => $faker->randomFloat(2,1,1000),
        'image' => $faker->imageUrl(80,80),
        'description' => $faker->text()
    ];
});