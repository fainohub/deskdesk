<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Ticket;
use App\Models\Customer;

class CustomerTicketShowTest extends TestCase
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

    public function testTicketNotFound()
    {
        $response = $this
            ->from(route('customer.tickets.index'))
            ->actingAs($this->customer)
            ->get(route('customer.tickets.show', ['id' => 500]));

        $response->assertRedirect(route('customer.tickets.index'));
    }
}
