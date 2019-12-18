<?php

namespace Tests\Unit\Repositories\Eloquent;

use App\Events\TicketCreated;
use Illuminate\Support\Facades\Event;
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
        Event::fake();

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

        Event::assertDispatched(TicketCreated::class, function ($e) use ($ticket) {
            return $e->ticket()->id === $ticket->id;
        });

        Event::assertDispatched(TicketCreated::class, 1);
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

    public function testCloseSuccess()
    {
        $ticket = factory(Ticket::class)->create();

        $this->assertEquals(Ticket::STATUS_OPEN, $ticket->status);

        $result = $this->ticketService->close($ticket->id);

        $this->assertNotEmpty($result);

        $ticket = $this->ticketService->find($ticket->id);

        $this->assertEquals(Ticket::STATUS_CLOSED, $ticket->status);
    }

    public function testNotFoundException()
    {
        $this->expectException(NotFoundException::class);

        $this->ticketService->find(500);
    }

    public function testAllocate()
    {
        $ticket = factory(Ticket::class)->create([
            'agent_id' => null
        ]);

        $this->assertEmpty($ticket->agent_id);

        $ticket = $this->ticketService->allocate($ticket);

        $this->assertNotEmpty($ticket->agent_id);
    }

    public function testCountAll()
    {
        $number = 10;

        factory(Ticket::class, $number)->create();

        $count = $this->ticketService->countAll();

        $this->assertEquals($number, $count);
    }

    public function testCountOpen()
    {
        $number = 10;

        factory(Ticket::class, $number)->create([
            'status' => Ticket::STATUS_OPEN
        ]);

        factory(Ticket::class, 5)->create([
            'status' => Ticket::STATUS_CLOSED
        ]);

        $count = $this->ticketService->countOpen();

        $this->assertEquals($number, $count);
    }

    public function testCountClosed()
    {
        $number = 10;

        factory(Ticket::class, 5)->create([
            'status' => Ticket::STATUS_OPEN
        ]);

        factory(Ticket::class, $number)->create([
            'status' => Ticket::STATUS_CLOSED
        ]);

        $count = $this->ticketService->countClosed();

        $this->assertEquals($number, $count);
    }
}
