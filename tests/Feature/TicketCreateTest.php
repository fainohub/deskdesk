<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Customer;
use App\Models\Ticket;

class TicketCreateTest extends TestCase
{
    private $customer;

    protected function setUp(): void
    {
        parent::setUp();

        $this->customer = factory(Customer::class)->create();
    }

    public function testCreateTicketIndex()
    {
        $response = $this
            ->actingAs($this->customer)
            ->get(route('customer.tickets.create'));

        $response->assertSuccessful();
        $response->assertViewIs('customer.tickets.create');
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
            ->actingAs($this->customer)
            ->post(route('customer.tickets.store'), $data);

        $response->assertRedirect(route('customer.tickets.index'));
    }
}
