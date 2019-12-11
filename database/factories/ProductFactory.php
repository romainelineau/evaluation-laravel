<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name'          =>  $faker->text($maxNbChars = 50),
        'description'   =>  $faker->paragraph(),
        'price'         =>  $faker->randomFloat($nbMaxDecimals = 2, $min = 0.01, $max = 400),
        'visible'       =>  rand(0,1) ? "published" : "unpublished",
        'status'        =>  rand(0,1) ? "standard" : "sale",
        'reference'     =>  $faker->unique()->regexify('[A-Z0-9]{16}')
    ];
});
