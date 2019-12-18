<?php

use Illuminate\Database\Seeder;
use App\Models\Agent;
use App\Models\Customer;
use App\Models\Ticket;
use App\Models\TicketMessage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $agent = Agent::create([
            'name'     => 'Agente 01',
            'email'    => 'admin@deskdesk.com.br',
            'password' => \Illuminate\Support\Facades\Hash::make('admin12345')
        ]);

        $customer = Customer::create([
            'name'     => 'José da Silva',
            'email'    => 'jose@deskdesk.com.br',
            'password' => \Illuminate\Support\Facades\Hash::make('admin12345')
        ]);

        $ticket = factory(Ticket::class)->create([
            'customer_id' => $customer->id,
            'agent_id'    => $agent->id,
        ]);

        factory(TicketMessage::class)->create([
            'ticket_id'        => $ticket->id,
            'commentable_id'   => $customer->id,
            'commentable_type' => Customer::class
        ]);

        factory(TicketMessage::class)->create([
            'ticket_id'        => $ticket->id,
            'commentable_id'   => $agent->id,
            'commentable_type' => Agent::class
        ]);

        factory(TicketMessage::class)->create([
            'ticket_id'        => $ticket->id,
            'commentable_id'   => $customer->id,
            'commentable_type' => Customer::class
        ]);
    }
}
