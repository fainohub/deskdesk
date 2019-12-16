<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Customer;
use App\Models\TicketMessage;

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
}
