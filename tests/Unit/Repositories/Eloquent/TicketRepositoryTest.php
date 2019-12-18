<?php

namespace Tests\Unit\Repositories\Eloquent;

use App\Models\TicketMessage;
use Tests\TestCase;
use App\Models\Agent;
use App\Models\Ticket;
use App\Models\Customer;
use App\Repositories\Contracts\TicketRepositoryInterface;

class TicketRepositoryTest extends TestCase
{
    /**
     * @var TicketRepositoryInterface
     */
    private $ticketRepository;

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

        $this->ticketRepository = $this->app->make(TicketRepositoryInterface::class);

        $this->customer = factory(Customer::class)->create();
        $this->agent = factory(Agent::class)->create();
    }

    public function testAll()
    {
        factory(Ticket::class)->create();

        $tickets = $this->ticketRepository->all();

        $this->assertNotEmpty($tickets);
    }

    public function testPaginate()
    {
        factory(Ticket::class)->create();

        $tickets = $this->ticketRepository->paginate();

        $this->assertNotEmpty($tickets);
    }

    public function testCreate()
    {
        $ticketFake = factory(Ticket::class)->make();

        $data = [
            'customer_id' => $ticketFake->customer_id,
            'title'       => $ticketFake->title,
            'description' => $ticketFake->description,
            'status'      => $ticketFake->status
        ];

        $ticket = $this->ticketRepository->create($data);

        $this->assertInstanceOf(Ticket::class, $ticket);
    }

    public function testUpdate()
    {
        $ticketFake = factory(Ticket::class)->create();

        $data = [
            'title' => 'Thiago'
        ];

        $ticket = $this->ticketRepository->update($data, $ticketFake->id);

        $this->assertEquals(1, $ticket);
    }

    public function testDelete()
    {
        $ticketFake = factory(Ticket::class)->create();

        $ticket = $this->ticketRepository->delete($ticketFake->id);

        $this->assertEquals(1, $ticket);
    }

    public function testFind()
    {
        $ticketFake = factory(Ticket::class)->create();

        $ticket = $this->ticketRepository->find($ticketFake->id);

        $this->assertInstanceOf(Ticket::class, $ticket);
        $this->assertEquals($ticketFake->id, $ticket->id);
        $this->assertEquals($ticketFake->customer_id, $ticket->customer_id);
        $this->assertEquals($ticketFake->title, $ticket->title);
        $this->assertEquals($ticketFake->description, $ticket->description);
        $this->assertEquals($ticketFake->status, $ticket->status);
    }

    public function testTicketsPaginatedByCustomer()
    {
        factory(Ticket::class)->create([
            'customer_id' => $this->customer->id
        ]);

        $tickets = $this->ticketRepository->ticketsPaginatedByCustomer($this->customer);

        $this->assertNotEmpty($tickets);
    }

    public function testTicketsPaginatedByAgent()
    {
        factory(Ticket::class)->create([
            'customer_id' => $this->customer->id,
            'agent_id'    => $this->agent->id
        ]);

        $tickets = $this->ticketRepository->ticketsPaginatedByAgent($this->agent);

        $this->assertNotEmpty($tickets);
    }

    public function testFindWithMessages()
    {
        $ticketFake = factory(Ticket::class)->create();

        factory(TicketMessage::class, 5)->create([
            'ticket_id'        => $ticketFake->id,
            'commentable_id'   => $ticketFake->customer_id,
            'commentable_type' => Customer::class
        ]);

        $ticket = $this->ticketRepository->findWithMessages($ticketFake->id);

        $this->assertInstanceOf(Ticket::class, $ticket);
        $this->assertEquals($ticketFake->id, $ticket->id);
        $this->assertEquals($ticketFake->customer_id, $ticket->customer_id);
        $this->assertEquals($ticketFake->title, $ticket->title);
        $this->assertEquals($ticketFake->description, $ticket->description);
        $this->assertEquals($ticketFake->status, $ticket->status);
        $this->assertNotEmpty($ticket->messages);
    }

    public function testCountAll()
    {
        $number = 10;

        factory(Ticket::class, $number)->create();

        $count = $this->ticketRepository->countAll();

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

        $count = $this->ticketRepository->countOpen();

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

        $count = $this->ticketRepository->countClosed();

        $this->assertEquals($number, $count);
    }
}
