<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(LaravelCommerce\User::class, function ($faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'address' => $faker->address,
        'city' => $faker->city,
        'state' => $faker->state,
        'postcode' => $faker->postcode,
        'password' => Hash::make(1234567),
        'remember_token' => str_random(10),
    ];
});

$factory->define(LaravelCommerce\Category::class, function ($faker) {
    return [
        'name' => $faker->numerify('Category ###'),
        'description' => $faker->sentence,
    ];
});

$factory->define(LaravelCommerce\Product::class, function ($faker) {
    return [
        'category_id' => $faker->numberBetween(1,10),
        'name' => $faker->numerify('Product #####'),
        'description' => $faker->text,
        'price' => $faker->randomFloat(2,100,200),
        'featured' => $faker->boolean(50),
        'recommend' => $faker->boolean(50),
    ];
});

$factory->define(LaravelCommerce\Status::class, function ($faker) {
    return [
        'name' => $faker->numerify('Status ###'),
    ];
});