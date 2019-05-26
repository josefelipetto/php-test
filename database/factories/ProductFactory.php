<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Product;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Product::class, function (Faker $faker) {
    $name = $faker->name();

    return [
        'name' => $name,
        'price' => $faker->randomFloat(2,1,1000),
        'image' => $faker->imageUrl(80,80),
        'description' => $faker->text(),
        'retailer_id' => function(){
            return factory(\App\Retailer::class)->create()->id;
        },
        'slug' => Str::slug($name)
    ];
});