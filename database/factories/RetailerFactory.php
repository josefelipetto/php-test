<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Retailer::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'logo' => $faker->imageUrl(80,80),
        'description' => implode(' . ', $faker->paragraphs(5)),
        'website' => $faker->url
    ];
});
