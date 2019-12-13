<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Agent;
use App\Models\Customer;
use App\Models\Ticket;
use Faker\Generator as Faker;

$factory->define(Ticket::class, function (Faker $faker) {
    return [
        'customer_id' => factory(Customer::class)->create()->id,
        'agent_id'    => factory(Agent::class)->create()->id,
        'title'       => $faker->text(150),
        'description' => $faker->text(500),
        'status'      => Ticket::STATUS_OPEN,
        'created_at'  => now(),
        'updated_at'  => now(),
    ];
});
