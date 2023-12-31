<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $quantity = rand(1,10);
    $price = $faker->randomNumber(3);
    return [
        'name'=>$faker->unique(999)->text(50),
        'quantity'=>$quantity,
        'price'=>$price,
        'total'=>$quantity * $price
    ];
});
