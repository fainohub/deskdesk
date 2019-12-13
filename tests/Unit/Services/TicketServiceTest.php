<?php

namespace Tests\Unit\Repositories\Eloquent;

use Tests\TestCase;
use App\Models\Ticket;
use App\Models\Customer;
use App\Http\Requests\StoreTicketRequest;
use App\Services\Contracts\TicketServiceInterface;

class TicketServiceTest extends TestCase
{
    /**
     * @var TicketServiceInterface
     */
    private $ticketService;

    /**
     * @var Customer
     */
    private $customer;

    protected function setUp(): void
    {
        parent::setUp();

        $this->ticketService = $this->app->make(TicketServiceInterface::class);

        $this->customer = factory(Customer::class)->create();
    }

    public function testCreate()
    {
        $request = new StoreTicketRequest();

        $ticketFake = factory(Ticket::class)->make();

        $request->merge([
            'title'       => $ticketFake->title,
            'description' => $ticketFake->description,
        ]);

        $ticket = $this->ticketService->create($request, $this->customer);

        $this->assertInstanceOf(Ticket::class, $ticket);
        $this->assertEquals($ticketFake->title, $ticket->title);
        $this->assertEquals($ticketFake->description, $ticket->description);
    }

    public function testListPaginate()
    {
        factory(Ticket::class)->create([
            'customer_id' => $this->customer->id
        ]);

        $tickets = $this->ticketService->paginateByCustomer($this->customer);

        $this->assertNotEmpty($tickets);
    }
}
