<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Customer;

class IndexTicketsTest extends TestCase
{
    private $customer;

    protected function setUp(): void
    {
        parent::setUp();

        $this->customer = factory(Customer::class)->create();
    }

    public function testTicketIndex()
    {
        $response = $this
            ->actingAs($this->customer)
            ->get(route('customer.tickets.index'));

        $response->assertSuccessful();
        $response->assertViewIs('customer.tickets.index');
    }
}
