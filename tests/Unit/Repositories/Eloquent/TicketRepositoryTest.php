<?php

namespace Tests\Unit\Repositories\Eloquent;

use Tests\TestCase;
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

    protected function setUp(): void
    {
        parent::setUp();

        $this->ticketRepository = $this->app->make(TicketRepositoryInterface::class);

        $this->customer = factory(Customer::class)->create();
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
}
