<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Models\Customer;
use App\Models\Ticket;
use App\Models\TicketMessage;

$factory->define(TicketMessage::class, function (Faker $faker) {
    return [
        'ticket_id'        => factory(Ticket::class)->create()->id,
        'message'          => $faker->text(150),
        'commentable_id'   => factory(Customer::class)->create()->id,
        'commentable_type' => Customer::class,
        'created_at'       => now(),
        'updated_at'       => now(),
    ];
});
