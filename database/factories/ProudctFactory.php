<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use App\User;
use App\Category;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description'=>$faker->sentence,
        'imege' => $faker->imageUrl,
        'priec' =>rand(20,1000),
        'user_id' =>User::all()->random()->id,
        'category_id' =>Category::all()->random()->id,
        'created_at'=>$faker->dateTimeThisYear
    ];
});
