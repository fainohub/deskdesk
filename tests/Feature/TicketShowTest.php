<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Ticket;
use App\Models\Customer;

class TicketShowTest extends TestCase
{
    private $customer;

    protected function setUp(): void
    {
        parent::setUp();

        $this->customer = factory(Customer::class)->create();
    }

    public function testTicketShow()
    {
        $ticket = factory(Ticket::class)->create([
            'customer_id' => $this->customer->id
        ]);

        $response = $this
            ->actingAs($this->customer)
            ->get(route('customer.tickets.show', ['id' => $ticket->id]));

        $response->assertSuccessful();
        $response->assertViewIs('customer.tickets.show');
        $response->assertViewHas('ticket');
    }
}
