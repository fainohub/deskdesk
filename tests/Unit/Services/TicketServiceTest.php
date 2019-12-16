<?php

namespace Tests\Unit\Repositories\Eloquent;

use Tests\TestCase;
use App\Models\Agent;
use App\Models\Ticket;
use App\Models\Customer;
use App\Http\Requests\StoreTicketRequest;
use App\Services\Contracts\TicketServiceInterface;
use App\Services\Exceptions\NotFoundException;

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

    /**
     * @var Agent
     */
    private $agent;

    protected function setUp(): void
    {
        parent::setUp();

        $this->ticketService = $this->app->make(TicketServiceInterface::class);

        $this->customer = factory(Customer::class)->create();
        $this->agent = factory(Agent::class)->create();
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

    public function testTicketsPaginatedByCustomer()
    {
        factory(Ticket::class)->create([
            'customer_id' => $this->customer->id
        ]);

        $tickets = $this->ticketService->ticketsPaginatedByCustomer($this->customer);

        $this->assertNotEmpty($tickets);
    }

    public function testTicketsPaginatedByAgent()
    {
        factory(Ticket::class)->create([
            'customer_id' => $this->customer->id,
            'agent_id'    => $this->agent->id
        ]);

        $tickets = $this->ticketService->ticketsPaginatedByAgent($this->agent);

        $this->assertNotEmpty($tickets);
    }

    public function testFindSuccess()
    {
        $ticketFaker = factory(Ticket::class)->create([
            'customer_id' => $this->customer->id
        ]);

        $ticket = $this->ticketService->find($ticketFaker->id);

        $this->assertInstanceOf(Ticket::class, $ticket);
    }

    public function testNotFoundException()
    {
        $this->expectException(NotFoundException::class);

        $this->ticketService->find(500);
    }
}
