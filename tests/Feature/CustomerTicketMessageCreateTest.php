<?php

namespace Tests\Feature;

use App\Models\TicketMessage;
use Tests\TestCase;
use App\Models\Customer;
use App\Models\Ticket;

class CustomerTicketMessageCreateTest extends TestCase
{
    private $customer;

    protected function setUp(): void
    {
        parent::setUp();

        $this->customer = factory(Customer::class)->create();
    }

    public function testCreateMessageSuccess()
    {
        $ticketMessage = factory(TicketMessage::class)->make();

        $data = [
            'message' => $ticketMessage->message,
        ];

        $response = $this
            ->actingAs($this->customer, 'customer')
            ->from(route('customer.tickets.show', ['id' => $ticketMessage->ticket_id]))
            ->post(route('customer.tickets.message.store', ['id' => $ticketMessage->ticket_id]), $data);

        $response->assertRedirect(route('customer.tickets.show', ['id' => $ticketMessage->ticket_id]));
    }

    public function testCreateTicketBasic()
    {
        $ticket = factory(Ticket::class)->make();

        $data = [
            'customer_id' => $ticket->customer_id,
            'title'       => $ticket->title,
            'description' => $ticket->description,
        ];

        $response = $this
            ->actingAs($this->customer, 'customer')
            ->post(route('customer.tickets.store'), $data);

        $response->assertRedirect(route('customer.tickets.index'));
    }
}
