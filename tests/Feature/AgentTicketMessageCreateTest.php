<?php

namespace Tests\Feature;

use Tests\TestCase;
<<<<<<< HEAD
use App\Models\Customer;
use App\Models\TicketMessage;

class CustomerTicketMessageCreateTest extends TestCase
{
    private $customer;
=======
use App\Models\Agent;
use App\Models\TicketMessage;

class AgentTicketMessageCreateTest extends TestCase
{
    private $agent;
>>>>>>> release/1.5.0

    protected function setUp(): void
    {
        parent::setUp();

<<<<<<< HEAD
        $this->customer = factory(Customer::class)->create();
=======
        $this->agent = factory(Agent::class)->create();
>>>>>>> release/1.5.0
    }

    public function testCreateMessageSuccess()
    {
        $ticketMessage = factory(TicketMessage::class)->make();

        $data = [
            'message' => $ticketMessage->message,
        ];

        $response = $this
<<<<<<< HEAD
            ->actingAs($this->customer, 'customer')
            ->from(route('customer.tickets.show', ['id' => $ticketMessage->ticket_id]))
            ->post(route('customer.tickets.message.store', ['id' => $ticketMessage->ticket_id]), $data);

        $response->assertRedirect(route('customer.tickets.show', ['id' => $ticketMessage->ticket_id]));
=======
            ->actingAs($this->agent, 'agent')
            ->from(route('agent.tickets.show', ['id' => $ticketMessage->ticket_id]))
            ->post(route('agent.tickets.message.store', ['id' => $ticketMessage->ticket_id]), $data);

        $response->assertRedirect(route('agent.tickets.show', ['id' => $ticketMessage->ticket_id]));
>>>>>>> release/1.5.0
    }
}
