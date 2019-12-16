<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Agent;
use Faker\Generator as Faker;

$factory->define(Agent::class, function (Faker $faker) {
    return [
        'name'       => $faker->name,
        'email'      => $faker->unique()->safeEmail,
        'password'   => $faker->password(8),
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
